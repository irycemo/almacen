<?php

namespace App\Http\Livewire;

use App\Models\Entrie;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;

class Entries extends Component
{

    use WithPagination;
    use ComponentsTrait;

    public $article_id;
    public $article;
    public $origin;
    public $description;
    public $quantity = 1;
    public $showArticles;
    public $searchArticle;
    public $price;
    public $articleDescription;

    protected function rules(){
        return[
            'origin' => 'required',
            'quantity' => 'required|min:1',
            'price' => 'nullable|numeric',
            'description' => 'required',
            'article' => 'required'
        ];
    }

    protected $messages = [
        'origin.required' => 'El campo origen es obligatorio.',
        'description.required' => 'El campo comentario es obligatorio.',
        'quantity.required' => 'El campo cantidad es obligatorio.',
        'article.required' => 'El campo artículo es obligatorio.',
    ];

    public function updatingSearchArticle(){
        $this->resetPage();
        $this->showArticles = true;
        $this->articleDescription = false;
    }

    public function updatedSearchArticle(){
        if($this->searchArticle == "")
            $this->showArticles = false;
    }

    public function resetAll(){
        $this->reset('article_id','selected_id','origin', 'price', 'articleDescription', 'searchArticle','showArticles', 'quantity', 'description');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalEdit($entrie){

        $this->dispatchBrowserEvent('showMessage',['warning', "Al editar la entrada solo se afectara el precio del artículo no la cantidad de stock del artículo, para afectar el stock del artículo es necesario hacer una nueva entrada."]);

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->article = Article::findorFail($entrie['article_id']);
        $this->article_id = $this->article->id;
        $this->articleDescription = true;
        $this->selected_id = $entrie['id'];
        $this->origin = $entrie['origin'];
        $this->price =  $entrie['price'] / $entrie['quantity'];
        $this->description = $entrie['description'];
        $this->quantity = $entrie['quantity'];

        $this->modal = true;
        $this->edit = true;
    }

    public function create(){

        $this->validate();

        if($this->origin == 'compra')
            $this->validate(['price' => 'required']);

        try {

            $article = Article::findorFail($this->article_id);

            if(!$article->serial)
                $stock = $article->stock + $this->quantity;
            else
                $stock = 1;

            DB::transaction(function () use($article, $stock) {

                Entrie::create([
                    'article_id' => $this->article_id,
                    'location' => auth()->user()->location,
                    'origin' => $this->origin,
                    'description' => $this->description,
                    'price' => $this->origin === 'donación' ? 0 : ($this->price * $this->quantity),
                    'quantity' => $article->serial ? 1 : $this->quantity,
                    'created_by' => auth()->user()->id,
                ]);

                $article->update([
                    'stock' => $stock,
                    'precio' => $this->price,
                    'updated_by' => auth()->user()->id
                ]);

                $this->dispatchBrowserEvent('showMessage',['success', "La entrada ha sido creada con éxito."]);

                $this->closeModal();

            });

        } catch (\Throwable $th) {

            Log::error("Error al crear entrada por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            DB::transaction(function () {

                $entrie = Entrie::findorFail($this->selected_id);

                if($this->article_id != $entrie->article->id){

                    if($entrie->article->requests->count()){

                        $this->dispatchBrowserEvent('showMessage',['error', "El artículo " . $entrie->article->name . " se encuentra en al menos una solicitud no es posible actualizar la entrada."]);

                        return;

                    }


                    $entrie->article->update(['stock' => ($entrie->article->stock - $entrie->quantity)]);

                }


                $article = Article::findorFail($this->article_id);

                $entrie->update([
                    'article_id' => $this->article_id,
                    'location' => auth()->user()->location,
                    'origin' => $this->origin,
                    'price' => $this->origin === 'donación' ? 0 : ($this->price * $this->quantity),
                    'description' => $this->description,
                    'quantity' => $article->serial ? 1 : $this->quantity,
                    'updated_by' => auth()->user()->id,
                ]);

                $article->update(
                    [
                        'precio' => $this->price,
                        'updated_by' => auth()->user()->id
                    ]
                );

                $this->dispatchBrowserEvent('showMessage',['success', "La entrada ha sido actualizada con éxito."]);

                $this->closeModal();

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar entrada por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function delete(){

        try {

            DB::transaction(function () {

                $entrie = Entrie::findorFail($this->selected_id);

                $entrie->article->update(['stock' => ($entrie->article->stock - $entrie->quantity)]);

                $entrie->delete();

            });

            $this->dispatchBrowserEvent('showMessage',['success', "La entrada ha sido eliminada con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar entrada por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);
            $this->closeModal();
        }
    }

    public function viewDetails($article){
        $this->article_id = $article['id'];
        $this->article = $article;

        $this->showArticles = false;
        $this->articleDescription = true;
    }

    public function render()
    {

        $articles = Article::with('entries')
                                ->where(function($q){
                                    return $q->where('location', 'general')
                                                ->where('name', 'LIKE', '%' . $this->searchArticle . '%');
                                })
                                ->orWhere('serial', $this->searchArticle);

        if($this->searchArticle)
            $articles = $articles->simplePaginate(5);

        $entries = Entrie::with('article', 'createdBy', 'updatedBy')
                            ->orWhere('description', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('origin', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('location', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('article', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.entries', compact('entries', 'articles'));
    }
}
