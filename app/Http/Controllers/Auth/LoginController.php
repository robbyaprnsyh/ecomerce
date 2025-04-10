<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        // $users = User::findOrFail(auth()->user()->id);
        // $users->status = 'aktif';
        // $users->save();
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard')->with('success', 'selamat datang admin');
        } else {
            // $users = User::findOrFail(auth()->user()->id);
            // $users->status = 'aktif';
            // $users->save();
            return redirect('/profil/akun')->with('success', 'selamat datang ' . auth()->user()->name);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
