<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTipoPago extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tipo_pago_id',
        'user_id'
    ];

    public function tipo_pago(){
        return $this->belongsTo(TipoPago::class);
    }
}
