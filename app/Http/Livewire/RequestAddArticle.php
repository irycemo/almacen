<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RequestAddArticle extends Component
{

    public $quantity = 1;
    public $article;

    public function addRequest($article){

        DB::transaction(function () use($article){

            $aux = Article::find($article['id']);

            if($aux->stock < $this->quantity){

                $this->dispatchBrowserEvent('showMessage',['error', "Solo puedes solicitar hasta " . $aux->stock . " unidades de este artículo"]);
                $this->quantity = 1;
                return;

            }

            if($this->quantity <= 0){
                $this->dispatchBrowserEvent('showMessage',['error', "La cantidad debe ser mayor a 0"]);
                $this->quantity = 1;
                return;
            }

            $content =  (object)[];

            $content->article = $article['name'];
            $content->quantity = $this->quantity;
            $content->serial = $article['serial'];
            $content->brand = $article['brand'];
            $content->id = $article['id'];
            $content->price = (float)$article['precio'] * $this->quantity;

            $this->emit('addOrCreateArticle', $content);

            $aux->stock = $aux->stock - $this->quantity;
            $aux->save();

            $this->quantity = 1;

        });

    }

    public function render()
    {
        return view('livewire.request-add-article');
    }
}
