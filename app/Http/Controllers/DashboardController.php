<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        $user = Auth::user();
        $auth_user = User::where('id', $user->id)->first();
        if($auth_user) 
            return view('dashboard');
    }
}
