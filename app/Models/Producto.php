<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'grupo_id',
        'producto',
        'detalle',
        'descripcion',
        'link',
        'show',
    ];

    public function valores(){
        return $this->hasMany(ProductoVariacion::class)->where('flag', TRUE)->orderBy('id', 'asc');
    }

    public function base(){
        return $this->hasOne(ProductoVariacion::class)->where(['flag'=> TRUE, 'base'=> TRUE]);
    }

    public function imagenes(){
        return $this->hasMany(ProductoImagen::class)->where('flag', TRUE)->orderBy('id', 'asc');
    }
}
