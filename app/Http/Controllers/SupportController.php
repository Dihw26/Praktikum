<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $supportInfo = []; 

        return view('support.index', compact('supportInfo'));
    }
}
