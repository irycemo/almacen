<?php

namespace App\Http\Livewire\Reports;

use App\Models\Request;
use Livewire\Component;
use App\Http\Constantes;

class ReportExpences extends Component
{

    public $expence_area;
    public $expencesSum;
    public $date1;
    public $date2;


    public function render()
    {

        $locations = collect(Constantes::UBICACIONES)->sort();

        $expences = Request::when(isset($this->expence_area) && $this->expence_area != "", function($query){
                                return $query->where('location', $this->expence_area)->where('status', 'entregada');
                            })
                            ->whereBetween('created_at', [$this->date1 . ' 00:00:00', $this->date2 . ' 23:59:59'])
                            ->get();

        $this->expencesSum = $expences->sum('price');

        return view('livewire.reports.report-expences', compact('locations', 'expences'));
    }
}
