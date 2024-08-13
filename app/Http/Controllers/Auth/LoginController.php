<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return $this->redirectTo();
    }

    /**
     * Determine the path to redirect to based on user role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $role = Auth::user()->checkrole;

        if ($role === 'admin') {
            return '/admin';
        } elseif ($role === 'owner') {
            return '/owner';
        }
        return '/home';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active'
        ];
    }
}
