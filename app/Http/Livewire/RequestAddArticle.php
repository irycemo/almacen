<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RequestAddArticle extends Component
{

    public $quantity = 1;
    public $article;
    public $request_id;

    public function addRequest(){

        if($this->quantity <= 0){
            $this->dispatchBrowserEvent('showMessage',['error', "La cantidad debe ser mayor a 0"]);
            $this->quantity = 1;
            return;
        }

        if($this->article['stock'] < $this->quantity){

            $this->dispatchBrowserEvent('showMessage',['error', "Solo puedes solicitar hasta " . $this->article['stock'] . " unidades de este artículo"]);
            $this->quantity = 1;
            return;

        }

        $object = [];

        $object['id'] = $this->article['id'];
        $object['quantity'] = (int)$this->quantity;

        $this->emit('addOrCreateArticle', $object);

        $this->quantity = 1;


    }

    public function render()
    {
        return view('livewire.request-add-article');
    }
}
