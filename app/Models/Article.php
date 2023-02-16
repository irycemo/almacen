<?php

namespace App\Models;

use App\Http\Traits\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements Auditable
{

    use HasFactory;
    use ModelsTrait;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id','created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function entries(){
        return $this->hasMany(Entrie::class);
    }
}
