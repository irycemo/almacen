<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
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

    public function receipt(Request $request){



        $receipt = PDF::loadView('livewire/request_receipt',[
            'request' => $request,
            'request_content' => json_decode($request->content, true),
            'date' => Carbon::createFromFormat('Y-m-d H:i:s', now())->format('d-m-Y H:i:s'),
            'user' => auth()->user()->name,
            'solicitante' => $request->createdBy->name
        ]);

        return $receipt->stream();
    }
}
