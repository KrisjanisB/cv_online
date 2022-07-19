<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $user = Auth::user();
        $user->load(['cv' => function ($query) {
            $query->orderBy('is_published', 'desc');
        }]);
        $cvs = $user->cv;

        return view('dashboard', compact('user', 'cvs'));
    }
}
