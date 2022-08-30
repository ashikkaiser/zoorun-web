<?php

function status()
{
    $status = array(
        [
            'id' => 'pickup-pending',
            'en' => 'Parcel is created successfully',
            'bn' => 'পার্সেলটি পিকআপের জন্য মার্চেন্ট অনুরোধ করেছেন',
        ],
        [
            'key' => 'pickup-assigned',
            'en' => 'Rider assigned to pick up the parcel',
            'bn' => 'পার্সেলটি পিকআপের জন্য ডেলিভারি ম্যান নিযুক্ত করা হয়েছে',
        ],
        [
            'key' => 'pickup-completed',
            'en' => 'Parcel is picked up',
            'bn' => 'পার্সেল পিকাপ সম্পন্ন হয়েছে',
        ],
        [
            'key' => 'pickup-cancelled',
            'en' => 'Parcel is cancelled',
            'bn' => 'পার্সেল পিকাপ সম্পূর্ণ বাতিল হয়েছে',
        ],
        [
            'key' => 'pickup-rejected',
            'en' => 'Parcel is rejected',
            'bn' => 'পার্সেল পিকাপ বাতিল হয়েছে',
        ],
        [
            'key' => 'received-to-warehouse',
            'en' => 'Parcel is received in {hub} Hub',
            'bn' => 'পার্সেলটি {hub} Hub এ রিসিভ করা হয়েছে',
        ],
        [
            'key' => 'dispatched-to-rider',
            'en' => 'Parcel is dispatched to {rider}',
            'bn' => 'পার্সেলটি {rider} এ ডিসপ্যাট করা হয়েছে',
        ],
        [
            'key' => 'delivery-in-progress',
            'en' => 'Parcel is on the way to delivery by {rider}',
            'bn' => 'ডেলিভারি এজেন্ট {rider} ডেলিভারির জন্যে বের হয়েছে',
        ],
        [
            'key' => 'delivery-completed',
            'en' => 'Parcel is delivered to {customer}',
            'bn' => 'পার্সেলটি {customer} এ ডেলিভারি করা হয়েছে',
        ],
        [
            'key' => 'delivery-cancelled',
            'en' => 'Parcel is cancelled',
            'bn' => 'পার্সেল ডেলিভারি সম্পূর্ণ বাতিল হয়েছে',
        ],
        [
            'key' => 'delivery-partially-completed',
            'en' => 'Parcel is partially delivered to {customer}',
            'bn' => 'পার্সেলটি {customer} এ আপনার অংশ ডেলিভারি করা হয়েছে',
        ],
    );
}
