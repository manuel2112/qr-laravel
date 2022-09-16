<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaPlan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'pago_id',
        'plan_id',
        'desde',
        'hasta',
        'free',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
