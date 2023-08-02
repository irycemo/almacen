<?php

namespace App\Http\Livewire\Reports;

use App\Models\User;
use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use App\Http\Constantes;
use Livewire\WithPagination;
use App\Exports\RequestsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportRequest extends Component
{

    use WithPagination;

    public $request_article_id;
    public $request_status;
    public $request_user;
    public $request_location;
    public $date1;
    public $date2;

    public $pagination = 10;

    public function downloadExcel(){

        $this->date1 = $this->date1 . ' 00:00:00';
        $this->date2 = $this->date2 . ' 23:59:59';

        return Excel::download(new RequestsExport($this->request_article_id, $this->request_location, $this->request_status, $this->request_user, $this->date1, $this->date2), 'Reporte_de_solicitudes_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $articles = Article::select('id', 'name')->orderBy('name')->get();

        $locations = collect(Constantes::UBICACIONES)->sort();

        $users = User::select('id', 'name')->orderBy('name')->get();

        $requests = Request::with('createdBy','updatedBy', 'requestDetails')
                            ->when(isset($this->request_article_id) && $this->request_article_id != "", function($query){
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
                            })
                            ->whereBetween('created_at', [$this->date1 . ' 00:00:00', $this->date2 . ' 23:59:59'])
                            ->paginate($this->pagination);

        return view('livewire.reports.report-request', compact('requests', 'articles', 'locations', 'users'));
    }
}
