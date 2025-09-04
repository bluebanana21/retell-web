<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Check user role and redirect accordingly
        if ($user->hasRole('admin')) {
            return view('dashboard');
        } else {
            // Regular users go to landing page
            return redirect('/');
        }
    }
}