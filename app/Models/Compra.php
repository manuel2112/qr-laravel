<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'plan_id',
        'meses',
        'neto',
        'iva',
        'total',
        'orden',
        'session_id',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function request(){
        return $this->hasOne(ComprasRequest::class);
    }
}
