<?php

namespace App\Http\Controllers;

use App\Models\Request;


class TrackingController extends Controller
{
    public function __invoke()
    {
        return view('tracking.index');
    }
}
