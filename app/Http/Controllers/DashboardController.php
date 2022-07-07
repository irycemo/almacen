<?php

namespace App\Http\Controllers;

use App\Models\Entrie;
use App\Models\Article;
use App\Models\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {

        if(auth()->user()->roles[0]->name == "Jefe(a) de Departamento"){

            $requests = Request::selectRaw('status, count(status) count')
                                    ->where('created_by', auth()->user()->id)
                                    ->groupBy('status')
                                    ->get();

        }else{

            $requests = Request::selectRaw('status, count(status) count')
                                    ->groupBy('status')
                                    ->get();

        }

        $entries = Entrie::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data, sum(price) sum')
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'asc')
                            ->get();

        $data = [];

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach($entries as $entrie){
            foreach($labels as $label){
                $data[$entrie->year][$label] = 0;
            }
        }

        foreach($entries as $entrie){

            foreach($labels as $label){

                if($entrie->month === $label ){
                    if($data[$entrie->year][$label] == 0)
                        $data[$entrie->year][$label] = $entrie->sum;
                }
            }

        }

        $articles = Article::where('serial', null)->whereBetween('stock', [1, 20])->orderBy('stock', 'asc')->get();

        return view('dashboard', compact('data', 'requests', 'articles'));
    }
}
