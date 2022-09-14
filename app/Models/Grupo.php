<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'grupo',
        'img',
    ];

    public function producto(){
        return $this->hasMany(Producto::class)->where('flag', TRUE)->orderBy('order', 'asc');
    }
}
