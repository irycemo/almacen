<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Reports extends Component
{

    public $area;
    public $showArticles = false;
    public $showRequests = false;
    public $showEntries = false;
    public $showExpences = false;

    public $date1;
    public $date2;

    public function updatedArea(){


        if($this->area == 1){

            $this->showArticles = false;
            $this->showRequests = false;
            $this->showEntries = true;
            $this->showExpences = false;


        }elseif($this->area == 2){

            $this->showArticles = true;
            $this->showRequests = false;
            $this->showEntries = false;
            $this->showExpences = false;

        }elseif($this->area == 3){

            $this->showArticles = false;
            $this->showExpences = false;
            $this->showEntries = false;
            $this->showRequests = true;

        }elseif($this->area == 4){

            $this->showArticles = false;
            $this->showExpences = true;
            $this->showEntries = false;
            $this->showRequests = false;

        }

    }

    public function render()
    {

        return view('livewire.reports');
    }
}
