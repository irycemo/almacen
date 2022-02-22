<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrieController extends Controller
{
    public function __invoke()
    {
        return view('entries.index');
    }
}
