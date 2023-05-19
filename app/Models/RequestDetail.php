<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestDetail extends Model
{
    use HasFactory;

    protected $table = 'article_request';

    protected $guarded = ['id'];

    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function request(){
        return $this->belongsTo(Request::class);
    }

}
