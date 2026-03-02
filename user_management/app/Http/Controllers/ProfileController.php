<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile (read-only).
     */
    public function show()
    {
        $user = Auth::user()->load(['office', 'accountRole']);

        return view('profile.show', compact('user'));
    }
}