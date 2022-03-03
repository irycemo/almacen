<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Entrie;
use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Exports\EntriesExport;
use App\Exports\ArticlesExport;
use App\Exports\RequestsExport;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Component
{

    use WithPagination;


    public $area;
    public $showArticles = false;
    public $showRequests = false;
    public $showEntries = false;
    public $category_id;
    public $date1;
    public $date2;

    public $article_name;
    public $article_brand;
    public $article_location;
    public $article_category_id;

    public $entrie_quantity;
    public $entrie_article_id;
    public $entrie_location;
    public $entrie_price1;
    public $entrie_price2;
    public $entrie_origin;

    public $request_article_id;
    public $request_status;
    public $request_user;
    public $request_location;

    public $requests_filtered;
    public $articles_filtered;
    public $entries_filtered;

    public function resetAll(){
        $this->reset(
                'showRequests',
                'showEntries',
                'showArticles',
                'article_name',
                'entrie_price1',
                'entrie_price2',
                'article_brand',
                'article_category_id',
                'article_location',
                'entrie_article_id',
                'entrie_origin',
                'request_status',
                'request_user',
                'entrie_location',
                'request_location'
        );
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedArea(){

        $this->resetAll();

        if($this->area == 1){

            $this->showArticles = false;
            $this->showRequests = false;
            $this->showEntries = true;

            $this->requests_filtered = null;
            $this->articles_filtered = null;


        }elseif($this->area == 2){

            $this->showArticles = true;
            $this->showRequests = false;
            $this->showEntries = false;

            $this->requests_filtered = null;
            $this->entries_filtered = null;

        }else{

            $this->showArticles = false;
            $this->showRequests =true;
            $this->showEntries = false;

            $this->articles_filtered = null;
            $this->entries_filtered = null;

        }

    }

    public function filterRequests(){

        $this->validate([
            'date1' => 'required|date',
            'date2' => 'required|date|after:date1',
        ],[
            'date1.required' => "La fecha inicial es obligatoria.",
            'date2.required' => "La fecha final es obligatoria.",
            'date2.after' => "El campo fecha final debe ser una fecha posterior a fecha inicial.",
        ]);

        $query = Request::query()->with('createdBy','updatedBy');

        $query->when(isset($this->request_article_id) && $this->request_article_id != "", function($query){
            return $query->where('content', 'LIKE', '%' . $this->request_article_id . '%');
        })
        ->when(isset($this->request_status) && $this->request_status != "", function($query){
            return $query->where('status', $this->request_status);
        })
        ->when(isset($this->request_location) && $this->request_location != "", function($query){
            return $query->where('location', $this->request_location);
        })
        ->when(isset($this->request_user) && $this->request_user, function($query){
            return $query->where('created_by', $this->request_user);
        });

        $this->requests_filtered = $query->whereBetween('created_at', [$this->date1, $this->date2])->get();

    }

    public function filterArticles(){

        $this->validate([
            'date1' => 'required|date',
            'date2' => 'required|date|after:date1',
        ],[
            'date1.required' => "La fecha inicial es obligatoria",
            'date2.required' => "La fecha final es obligatoria",
            'date2.after' => "El campo fecha final debe ser una fecha posterior a fecha inicial.",
        ]);

        $query = Article::query()->with('createdBy','updatedBy', 'category');

        $query->when(isset($this->article_name) && $this->article_name != "", function($query){
            return $query->where('name', 'LIKE', '%' . $this->article_name . '%');
        })
        ->when(isset($this->article_brand) && $this->article_brand != "", function($query){
            return $query->where('brand', 'LIKE', '%' . $this->article_brand . '%');
        })
        ->when(isset($this->article_category_id) && $this->article_category_id != "", function($query){
            return $query->where('category_id', $this->article_category_id);
        })
        ->when(isset($this->article_location) && $this->article_location != "", function($query){
            return $query->where('location', $this->article_location);
        });

        $this->articles_filtered = $query->whereBetween('created_at', [$this->date1, $this->date2])->get();

    }

    public function filterEntries(){

        $this->validate([
            'date1' => 'required|date',
            'date2' => 'required|date|after:date1',
            'entrie_price1' => 'nullable|numeric|required_with:entrie_price2',
            'entrie_price2' => 'nullable|numeric|required_with:entrie_price1|gt:entrie_price1'
        ],[
            'date1.required' => "La fecha inicial es obligatoria",
            'date2.required' => "La fecha final es obligatoria",
            'date2.after' => "El campo fecha final debe ser una fecha posterior a fecha inicial.",
            'entrie_price1.required_with' => "Al usar un valor de precio, precio inicial y final deben tener valores",
            'entrie_price2.required_with' => "Al usar un valor de precio, precio inicial y final deben tener valores",
            'entrie_price2.gt' => "El precio final debe ser mayor al precio inicial",
            'entrie_price1.numeric' => "El precio debe ser numerico",
            'entrie_price2.numeric' => "El precio debe ser numerico",
        ]);

        $query = Entrie::query()->with('createdBy','updatedBy','article');

        $query->when(isset($this->entrie_article_id) && $this->entrie_article_id != "", function($query){
            return $query->where('article_id', $this->entrie_article_id);
        })
        ->when(isset($this->entrie_location) && $this->entrie_location != "", function($query){
            return $query->where('location', $this->entrie_location);
        })
        ->when(isset($this->entrie_origin) && $this->entrie_origin != "", function($query){
            return $query->where('origin', $this->entrie_origin);
        })
        ->when(isset($this->entrie_price1) && isset($this->entrie_price2) && $this->entrie_price1 != ""  && $this->entrie_price2 != "", function($query){
            return $query->whereBetween('price', [$this->entrie_price1, $this->entrie_price2]);
        });

        $this->entries_filtered = $query->whereBetween('created_at', [$this->date1, $this->date2])->get();

    }

    public function downloadExcel($type){

        if($type == 1)
            return Excel::download(new EntriesExport($this->entrie_article_id, $this->entrie_location, $this->entrie_origin, $this->entrie_price1, $this->entrie_price2, $this->date1, $this->date2), 'Reporte_de_entradas_' . now()->format('d-m-Y') . '.xlsx');
        elseif ( $type == 2)
            return Excel::download(new ArticlesExport($this->article_name, $this->article_location, $this->article_brand, $this->article_category_id, $this->date1, $this->date2), 'Reporte_de_articulos_' . now()->format('d-m-Y') . '.xlsx');
        else
            return Excel::download(new RequestsExport($this->request_article_id, $this->request_location, $this->request_status, $this->request_user, $this->date1, $this->date2), 'Reporte_de_solicitudes_' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {

        $categories = Category::all();

        $articles = Article::orderBy('name')->get();

        $users = User::orderBy('name')->get();

        return view('livewire.reports', compact('categories', 'articles', 'users'));
    }
}
