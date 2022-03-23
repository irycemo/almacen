<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{

    const AREAS = [
        'Roles',
        'Permisos',
        'Usuarios',
        'Categorías',
        'Entradas',
        'Artículos',
        'Solicitudes',
        'Seguimiento',
        'Reportes'
    ];

    const UBICACIONES = [
        'RPP',
        'Catastro',
        'Regional Morelia',
        'Regional Uruapan',
        'Regional Patzcuaro',
        'Regional Zamora',
        'Regional Zitacuaro',
        'Regional La Piedad',
        'Regional Apatzingan',
        'Regional Lazaro Cardenas'
    ];

    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function entries(){
        return $this->hasMany(Entrie::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getCreatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }
}
