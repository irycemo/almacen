<?php

namespace App\Http\Livewire\Reports;

use App\Models\Entrie;
use App\Models\Article;
use Livewire\Component;
use App\Http\Constantes;
use Livewire\WithPagination;
use App\Exports\EntriesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportEntrie extends Component
{

    use WithPagination;

    public $entrie_quantity;
    public $entrie_article_id;
    public $entrie_location;
    public $entrie_price1;
    public $entrie_price2;
    public $entrie_origin;
    public $date1;
    public $date2;

    public $pagination = 10;

    public function downloadExcel(){

        $this->date1 = $this->date1 . ' 00:00:00';
        $this->date2 = $this->date2 . ' 23:59:59';

        return Excel::download(new EntriesExport($this->entrie_article_id, $this->entrie_location, $this->entrie_origin, $this->entrie_price1, $this->entrie_price2, $this->date1, $this->date2), 'Reporte_de_entradas_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $articles = Article::select('id', 'name')->orderBy('name')->get();

        $locations = collect(Constantes::UBICACIONES)->sort();

        $entries = Entrie::with('createdBy','updatedBy','article')
                            ->when(isset($this->entrie_article_id) && $this->entrie_article_id != "", function($query){
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
                            })
                            ->whereBetween('created_at', [$this->date1 . ' 00:00:00', $this->date2 . ' 00:00:00'])->paginate($this->pagination);

        return view('livewire.reports.report-entrie', compact('entries', 'articles', 'locations'));
    }
}
