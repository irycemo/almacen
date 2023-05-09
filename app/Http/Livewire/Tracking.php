<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Tracking extends Component
{

    use WithPagination;

    public $modal = false;
    public $modalDelete = false;
    public $create = false;
    public $edit = false;
    public $search='';
    public $sort = 'id';
    public $direction = 'desc';

    public $request_id;
    public $request_content = [];
    public $request_status;
    public $request_number;
    public $request_author;
    public $request_created_at;
    public $request_comment;
    public $comment;
    public $showRequests = false;
    public $showArticles = false;
    public $articleName;
    public $requests;
    public $article;
    public $articleDescription = false;

    public function updatingSearch(){
        $this->resetPage();
        $this->showArticles = true;
        $this->showRequests = false;
        $this->articleDescription = false;
    }

    public function updatedSearch(){
        if($this->search == ""){
            $this->showArticles = false;
            $this->showRequests = false;
            $this->articleDescription = false;
        }
    }

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function resetAll(){
        $this->reset('request_id','request_status', 'request_content', 'request_number', 'request_author', 'request_created_at','request_comment', 'comment');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalDetail($request){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->request_id = $request['id'];
        $this->request_status = $request['status'];
        $this->request_content = json_decode($request['content'],true);
        $this->request_author = $request['created_by']['name'];
        $this->request_number = $request['number'];
        $this->request_created_at = $request['created_at'];
        $this->request_comment = $request['comment'];

        $this->modal = true;
        $this->edit = true;

    }

    public function openModalDelete($request){

        $this->modalDelete = true;
        $this->request_id = $request['id'];
    }

    public function closeModal(){
        $this->resetAll();
        $this->modal = false;
    }

    public function viewDetails($article){

        $this->article = Article::query()->with('entries.article', 'entries.createdBy', 'entries.updatedBy')->where('id', $article['id'])->first();

        $this->showArticles = false;
        $this->showRequests = true;
        $this->articleDescription = true;

        if($article['serial']){
            $this->requests = Request::query()->with('createdBy', 'updatedBy')
                                ->where('content', 'LIKE', '%' . $article['serial'] . '%')
                                ->get();
        }else{
            $this->requests = Request::query()->with('createdBy', 'updatedBy')
                                ->where(function($q) use ($article){
                                    $q->where('content', 'LIKE', '%' . $article['name'] . '%')
                                        ->where('content', 'LIKE', '%' . $article['brand'] . '%');
                                })
                                ->orWhere('content', 'LIKE', '%"id":' . $article['id'] . '%')
                                ->orWhere('content', 'LIKE', '%"id": ' . $article['id'] . '%')
                                ->get();
        }
    }

    public function render()
    {

        $articles = Article::where('name', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('serial', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('brand', 'LIKE', '%' . $this->search . '%');

        if($this->search)
            $articles = $articles->paginate(10);

        return view('livewire.tracking', compact('articles'));
    }
}
