<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;

class RequestAvailableArticle extends Component
{

    public $article_id;
    public $article;
    public $requested;

    public function mount(){


        $this->article = Article::find((int)$this->article_id);

        if($this->article->serial){

            $this->requested = Request::query()->with('createdBy', 'updatedBy')
                                ->where('content', 'LIKE', '%' . $this->article->name . '%')
                                ->where('content', 'LIKE', '%' . $this->article->brand . '%')
                                ->where('content', 'LIKE', '%' . $this->article->serial . '%')
                                ->where('status', '!=', 'entregada')
                                ->get();

        }else{

            $this->requested = Request::query()->with('createdBy', 'updatedBy')
                                ->where('content', 'LIKE', '%' . $this->article->name . '%')
                                ->where('content', 'LIKE', '%' . $this->article->brand . '%')
                                ->get();

        }

        $this->requested = count($this->requested);
    }

    public function render()
    {
        return view('livewire.request-available-article');
    }
}
