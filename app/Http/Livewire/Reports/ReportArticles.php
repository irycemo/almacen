<?php

namespace App\Http\Livewire\Reports;

use App\Models\Article;
use Livewire\Component;
use App\Http\Constantes;
use App\Models\Category;
use Livewire\WithPagination;
use App\Exports\ArticlesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportArticles extends Component
{

    use WithPagination;

    public $article_name;
    public $article_brand;
    public $article_location;
    public $article_category_id;
    public $date1;
    public $date2;

    public $pagination = 10;

    public function downloadExcel(){

        $this->date1 = $this->date1 . ' 00:00:00';
        $this->date2 = $this->date2 . ' 23:59:59';

        return Excel::download(new ArticlesExport($this->article_name, $this->article_location, $this->article_brand, $this->article_category_id, $this->date1, $this->date2), 'Reporte_de_articulos_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $categories = Category::orderBy('name')->get();

        $ubicaciones = collect(Constantes::UBICACIONES)->sort();

        $articles = Article::with('createdBy','updatedBy', 'category')
                                ->when(isset($this->article_name) && $this->article_name != "", function($query){
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
                                })
                                ->whereBetween('created_at', [$this->date1 . ' 00:00:00', $this->date2 . ' 23:59:59'])->paginate($this->pagination);

        return view('livewire.reports.report-articles', compact('articles', 'ubicaciones', 'categories'));
    }
}
