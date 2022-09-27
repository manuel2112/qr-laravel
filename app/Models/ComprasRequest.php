<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasRequest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'compra_id',
        'accounting_date',
        'card_number',
        'amount',
        'authorization_code',
        'payment_type_code',
        'response_code',
        'transaction_date',
        'vci',
        'status',
        'installments_amount',
        'installments_number',
        'balance',
    ];
}
