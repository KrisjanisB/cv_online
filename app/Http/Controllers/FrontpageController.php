<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function __invoke()
    {
        $cvs = CV::publicAccessable()->get();
        return view('frontpage', compact('cvs'));
    }
}
