<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->with('login_error', 'wrong_email')->onlyInput('email');
        }

        if ($token = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->authenticated($request, Auth::user(), $token);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('login_error', 'incorrect_password')->onlyInput('email');
    }

    protected function authenticated(Request $request, $user, $token)
    {
        $redirect = null;
        // 1: Admin, 2: HR, 3: Employee
        // Using intval to ensure type safety if database returns string
        switch (intval($user->user_type)) {
            case 1:
                $redirect = redirect()->route('admin.dashboard');
                break;
            case 2:
                $redirect = redirect()->route('hr.dashboard');
                break;
            case 3:
                $redirect = redirect()->route('employees.dashboard');
                break;
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Unauthorized user type.']);
        }

        return $redirect->withCookie(cookie('token', $token, 30, null, null, false, true));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withCookie(cookie()->forget('token'));
    }
}
