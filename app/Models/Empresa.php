<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'direccion',
        'fono',
        'empresa',
        'ciudad_id',
        'referido',
        'slug',
    ];

    public function ciudad(){
        return $this->belongsTo(Commune::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
