<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//         $this->middleware('guest')->except('smartlogout');
    }
    
    protected function authenticated(Request $request, $user)
    {
//       dd( $request->getClientIp());
    //     $user->update([
        
    //     'last_login_ip' => $request->getClientIp()
    // ]);
    }
      protected function validateLogin(Request $request)
    {
        
        // dd($request);
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
         
    }
    public function username()
    {
        return 'pgapp_id';
    }
      protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
    public function showLoginForm()
    {
        return view('welcome');
    }
   
}
