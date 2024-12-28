<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ImpersonateController extends Controller
{
    public function start($id)
    {
        $user = User::find($id);
        if ($user) {
            session(['original_user' => Auth::user()]);
            Auth::user()->impersonate($user);
            return redirect()->route('home')->with('success', 'You are now impersonating ' . $user->name);
        }
        return redirect()->route('home')->with('error', 'User not found.');
    }

    public function stop()
    {
        if (Auth::user() && Auth::user()->isImpersonated()) {
            Auth::user()->leaveImpersonation();
            session()->forget('original_user');
            return redirect()->route('home')->with('success', 'You have returned to your original account.');
        }
        return redirect()->route('home')->with('error', 'You are not impersonating anyone.');
    }
}
