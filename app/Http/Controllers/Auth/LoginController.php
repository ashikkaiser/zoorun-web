<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    //Login view function
    public function login()
    {
        return view("auth.login");
    }

    public function loginStore(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required:min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (auth()->user()->user_type === "admin") {
                return redirect()->route('admin.dashboard');
            }

            if (auth()->user()->user_type === "branch") {
                return redirect()->route('branch.dashboard');
            }

            if (auth()->user()->user_type === "manager") {
                return redirect()->route('manager.dashboard');
            }

            if (auth()->user()->user_type === "merchant") {
                return redirect()->route('merchant.dashboard');
            }

            if (auth()->user()->user_type === "rider") {
                return redirect()->route('rider.dashboard');
            }

            if (auth()->user()->user_type === "warehouse") {
                return redirect()->route('warehouse.dashboard');
            }
        }

        return redirect("login")->with('error', 'Login details are not valid');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect('login');
    }
}
