<?php

namespace App\Models;

use App\Http\Traits\ModelsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{

    use HasFactory;
    use ModelsTrait;

    protected $guarded = ['id','created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function entries(){
        return $this->hasMany(Entrie::class);
    }
}
