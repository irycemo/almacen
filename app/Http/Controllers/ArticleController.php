<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){

        return view('articles.index');

    }

    public function catastro(){
        return view('articles.catastro');
    }

    public function rpp(){
        return view('articles.rpp');
    }
}
