<?php

namespace App\Models;

use Illuminate\Support\Str;
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

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($empresa) {

    //         $empresa->slug = $empresa->createSlug($empresa->slug);

    //         $empresa->save();
    //     });
    // }

    // /** 
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    // private function createSlug($name)
    // {
    //     if (static::whereSlug($slug = Str::slug($name))->exists()) {

    //         $max = static::whereEmpresa($name)->latest('id')->skip(1)->value('slug');

    //         if (isset($max[-1]) && is_numeric($max[-1])) {

    //             return preg_replace_callback('/(\d+)$/', function ($mathces) {

    //                 return $mathces[1] + 1;
    //             }, $max);
    //         }
    //         return "{$slug}-2";
    //     }
    //     return $slug;
    // }
}
