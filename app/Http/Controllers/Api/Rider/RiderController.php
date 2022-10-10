<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\RiderParcel;
use App\Models\RiderRun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function dashboard()
    {
        $request_pickup = RiderRun::whereNull('rider_id')->where('run_type', 'pickup')->where('status', 1)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();

        $running_pickup
            = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'pickup')->where('status', 2)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten()->count();
        $complete_pickup
            = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'pickup')->where('status', 3)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten()->count();

        $recent_request = Parcel::query()->whereIn('id', $request_pickup)->with(['merchant', 'pickup_address', 'riderParcel', 'branchs'])->withRiderRunPickup();

        return response()->json([
            'request_pickup' => $request_pickup->count() ?? 0,
            'running_pickup' => $running_pickup,
            'complete_pickup' => $complete_pickup,
            'recent_request' => $recent_request,
            'balance' => 0,
        ]);
    }


    public function pickupRequest(Request $request)
    {

        $parcels_ids = RiderRun::whereNull('rider_id')->where('run_type', 'pickup')->where('status', 1)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();
        $parcels = Parcel::query()->whereIn('id', $parcels_ids)->where('branch_id', Auth::user()->branch_id)->with(['merchant', 'pickup_address',  'branchs'])
            ->withRiderRunPickup();

        return response()->json([
            'success' => true,
            'data' => $parcels
        ]);
    }

    public function pickupModify(Request $request)
    {

        $parcel = Parcel::find($request->parcel_id);
        if ($request->type === 'accept') {
            if ($parcel->status == 'pickup-assigned') {
                return response()->json([
                    'success' => false,
                    'message' => 'Parcel already assigned to another rider'
                ]);
            }
            $rider_parcel = RiderParcel::where('rider_run_id', $parcel->pickup_rider_run_id)->get();
            foreach ($rider_parcel as $item) {
                $p = Parcel::find($item->parcel_id);
                $p->pickupriderParcel->status = 2;
                $p->pickupriderParcel->rider_id = Auth::user()->rider()->first()->id;
                $p->status = 'pickup-assigned';
                $run = RiderRun::find($p->pickupriderParcel->rider_run_id);
                $run->rider_id = Auth::user()->rider()->first()->id;
                $run->status = 2;
                $run->save();
                $p->push();
            }
            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Parcel assigned to you'

            ]);
        }

        if ($request->type === 'confirm') {
            if ($parcel->status == 'pickup-completed') {

                return response()->json([
                    'success' => false,
                    'message' => 'Parcel already completed'
                ]);
            }
            $parcel->status = 'pickup-completed';
            $parcel->pickupriderParcel->status = 3;
            $parcel->rider_run->complete_parcel = $parcel->rider_run->complete_parcel + 1;
            $parcel->push();
            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Parcel confirmed'
            ]);
        }

        if ($request->type === 'reschedule') {
            if ($parcel->status == 'pickup-rescheduled') {

                return response()->json([
                    'success' => false,
                    'message' => 'Parcel already rescheduled'
                ]);
            }
            $parcel->status = 'pickup-rescheduled';
            $parcel->pickup_reschedule_date = $request->reschedule_date;
            $parcel->pickup_reschedule_attempts = $parcel->pickup_reschedule_attempts ? $parcel->pickup_reschedule_attempts + 1 : 1;
            $parcel->rider_run->complete_parcel = $parcel->rider_run->total_parcel - 1;
            $parcel->push();
            $riderRun = RiderRun::find($parcel->pickup_rider_run_id);
            RiderParcel::where('rider_run_id', $riderRun->id)->where('parcel_id', $parcel->id)->delete();

            $riderRun = new RiderRun();
            $riderRun->branch_id = Auth::user()->branch_id;
            $riderRun->merchant_id = $parcel->merchant_id;
            $riderRun->run_type = 'delivery';
            $riderRun->create_date_time = Carbon::parse($request->reschedule_date);
            $riderRun->total_parcel = 1;
            $riderRun->status = 1;
            if ($riderRun->save()) {
                riderRunStart($riderRun, $parcel->id);
                $parcel->status = 'pickup-accepted';
                $parcel->pickup_rider_run_id = $riderRun->id;
                $parcel->save();
            }

            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Parcel rescheduled'
            ]);
        }
    }

    public function pickupRunning(Request $request)
    {
        $parcels_ids = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'pickup')->where('status', 2)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();
        $parcels = Parcel::query()->whereIn('id', $parcels_ids)->orderBy('id', 'desc')->with(['merchant', 'pickup_address', 'branchs'])->withRiderRunPickup();
        return response()->json([
            'success' => true,
            'data' => $parcels
        ]);
    }



    public function deliveryRequest(Request $request)
    {
        $parcels_ids = RiderRun::whereNull('rider_id')->where('run_type', 'delivery')->where('status', 1)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();
        $parcels = Parcel::query()
            ->whereIn('id', $parcels_ids)
            ->orderBy('id', 'desc')
            ->with(['merchant', 'pickup_address', 'branchs'])
            ->withRiderRunDelivery();
        return response()->json([
            'success' => true,
            'data' => $parcels
        ]);
    }

    public function deliveryRunning()
    {
        $parcels_ids = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'delivery')->where('status', 2)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();
        $parcels = Parcel::query()
            ->whereIn('id', $parcels_ids)
            ->orderBy('id', 'desc')
            ->with(['merchant', 'pickup_address', 'branchs'])
            ->withRiderRunDelivery();
        return response()->json([
            'success' => true,
            'data' => $parcels
        ]);
    }



    public function deliveryModify(Request $request)
    {

        $parcel = Parcel::find($request->parcel_id);
        if ($request->type === 'accept') {
            if ($parcel->status == 'delivery-assigned') {

                return response()->json([
                    'success' => false,
                    'message' => 'Parcel already accepted by another rider'
                ]);
            }

            $parcel->riderParceldelivery->status = 2;
            $parcel->riderParceldelivery->rider_id = Auth::user()->rider()->first()->id;
            $parcel->status = 'delivery-assigned';
            $run = RiderRun::find($parcel->delivery_rider_run_id);
            $run->rider_id = Auth::user()->rider()->first()->id;
            $run->status = 2;
            $run->save();
            $parcel->push();
            return response()->json([
                'success' => true,
                'title' => "Parcel Accepted",
                'message' => 'Please Collect Parcel From Warehouse'
            ]);
        }

        if ($request->type === 'send_otp') {
            if ($parcel->delivery_otp) {
                return response()->json([
                    'success' => true,
                    'title' => "Zoorun",
                    'message' => 'Otp sent',
                    'data' => $parcel->delivery_otp
                ]);
            }
            $parcel->delivery_otp = rand(100000, 999999);
            $parcel->save();
            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Otp sent',
                'data' => $parcel->delivery_otp
            ]);
        }
        if ($request->type === 'resend_otp') {
            $parcel->delivery_otp = rand(100000, 999999);
            $parcel->save();
            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Otp sent',
                'data' => $parcel->delivery_otp
            ]);
        }

        if ($request->type === 'confirm') {
            $parcel = Parcel::find(request()->parcel_id);
            if ($parcel->delivery_otp == request()->otp) {
                if ($request->deliveryType == "2") {
                    $parcel->status = 'delivery-partially-completed';
                } else {
                    $parcel->status = 'delivery-completed';
                }
                $parcel->collected_amount   = $request->collection_amount;
                $parcel->riderParceldelivery->status = 3;
                $parcel->rider_run->complete_parcel = $parcel->rider_run->complete_parcel + 1;
                $parcel->push();
                riderDeliveryEnd($parcel->delivery_rider_run_id);
                return response()->json([
                    'success' => true,
                    'title' => "Zoorun",
                    'message' => 'Parcel Confirmed'
                ]);
            }
            return response()->json(
                [
                    'success' => false,
                    'title' => "Zoorun",
                    'message' => 'Invalid OTP'
                ]
            );
        }

        if ($request->type === 'reschedule') {
            if ($parcel->status == 'delivery-rescheduled') {

                return response()->json([
                    'success' => false,
                    'message' => 'Parcel already rescheduled'
                ]);
            }
            $parcel->status = 'delivery-rescheduled';
            $parcel->delivery_reschedule_date = $request->reschedule_date;
            $parcel->delivery_reschedule_attempts = $parcel->delivery_reschedule_attempts ? $parcel->delivery_reschedule_attempts + 1 : 1;
            $parcel->rider_run->complete_parcel = $parcel->rider_run->total_parcel - 1;
            $parcel->push();
            // $riderRun = RiderRun::find($parcel->delivery_rider_run_id);
            // RiderParcel::where('rider_run_id', $riderRun->id)->where('parcel_id', $parcel->id)->delete();

            // $riderRun = new RiderRun();
            // $riderRun->branch_id = Auth::user()->branch_id;
            // $riderRun->merchant_id = $parcel->merchant_id;
            // $riderRun->run_type = 'pickup';
            // $riderRun->create_date_time = Carbon::parse($request->reschedule_date);
            // $riderRun->total_parcel = 1;
            // $riderRun->status = 1;
            // if ($riderRun->save()) {
            //     riderRunStart($riderRun, $parcel->id);
            //     $parcel->status = 'pickup-accepted';
            //     $parcel->pickup_rider_run_id = $riderRun->id;
            //     $parcel->save();
            // }

            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Parcel rescheduled'
            ]);
        }
    }


    public function returnRequest()
    {
        $parcels_ids = RiderRun::whereNull('rider_id')->where('run_type', 'return')->where('status', 1)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();
        $parcels = Parcel::query()
            ->whereIn('id', $parcels_ids)
            ->orderBy('id', 'desc')
            ->with(['merchant', 'pickup_address', 'branchs'])
            ->withRiderRunReturn();
        return response()->json([
            'success' => true,
            'data' => $parcels
        ]);
    }

    public function returnRunning(Request $request)
    {
        $parcels_ids = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'return')->where('status', 2)
            ->with('rider_parcel')->get()->map(function ($item) {
                return $item->rider_parcel->map(function ($item) {
                    return $item->parcel_id;
                });
            })->flatten();
        $parcels = Parcel::query()
            ->whereIn('id', $parcels_ids)
            ->orderBy('id', 'desc')
            ->with(['merchant', 'pickup_address', 'branchs'])
            ->withRiderRunReturn();
        return response()->json([
            'success' => true,
            'data' => $parcels
        ]);
    }


    public function returnModify(Request $request)
    {
        $parcel = Parcel::find($request->parcel_id);

        if ($request->type === 'accept') {
            if ($parcel->status == type($parcel->status, 'accept')) {

                return response()->json([
                    'success' => false,
                    'message' => 'Parcel already accepted by another rider'
                ]);
            }


            if ($parcel->return_status === 'parcel-delivery-returning') {
                $parcel->riderParcelRetrunDelivery->status = 2;
                $parcel->riderParcelRetrunDelivery->rider_id = Auth::user()->rider()->first()->id;
                $parcel->return_status = 'return-delivery-in-progress';
                $run = RiderRun::find($parcel->return_delivery_rider_run_id);
            } else {
                $parcel->riderParcelRetrunPickup->status = 2;
                $parcel->riderParcelRetrunPickup->rider_id = Auth::user()->rider()->first()->id;
                $parcel->return_status = 'return-pickup-in-progress';
                $run = RiderRun::find($parcel->return_pickup_rider_run_id);
            }


            $run->rider_id = Auth::user()->rider()->first()->id;
            $run->status = 2;
            $run->save();
            $parcel->push();
            return response()->json([
                'success' => true,
                'title' => "Parcel Accepted",
                'message' => 'Please Collect Parcel From Warehouse'
            ]);
        }

        if ($request->type === 'confirm') {
            $parcel = Parcel::find(request()->parcel_id);
            if ($parcel->return_status === 'return-delivery-assigned') {
                $parcel->riderParcelRetrunDelivery->status = 2;
                $parcel->return_status = 'return-delivery-completed';
                $run = RiderRun::find($parcel->return_delivery_rider_run_id);
            } else {
                $parcel->riderParcelRetrunPickup->status = 3;
                $parcel->return_status = 'return-pickup-completed';
                $run = RiderRun::find($parcel->return_pickup_rider_run_id);
            }

            $run->complete_parcel = $run->complete_parcel + 1;
            $run->save();
            $parcel->push();
            if ($parcel->return_status == 'return-delivery-completed') {
                riderDeliveryEnd($parcel->return_delivery_rider_run_id);
            }
            return response()->json([
                'success' => true,
                'title' => "Zoorun",
                'message' => 'Parcel Confirmed'
            ]);
        }
    }
}
