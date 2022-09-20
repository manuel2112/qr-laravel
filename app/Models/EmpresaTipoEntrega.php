<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTipoEntrega extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tipo_entrega_id',
        'user_id'
    ];

    public function tipo_entrega(){
        return $this->belongsTo(TipoEntrega::class);
    }
}
