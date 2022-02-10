<?php

namespace App\Http\Controllers;

use App\Models\Request;


class RequestController extends Controller
{
    public function index(){

        return view('requests.index');

    }

    public function create(){
        return view('requests.create');
    }

    public function edit(Request $request){

        $this->authorize('view', $request);

        return view('requests.edit', compact('request'));
    }
}
