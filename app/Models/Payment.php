<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'payments';
    protected $fillable = [
        'email',
        'no_telp',
        'qty',
        'total',
        'status',
        'destinasi_id',
        'order_id'
    ];

    // public function destinasi()
    // {
    //     return $this->belongsTo(Destinasi::class, 'destinasi_id', 'id');
    // }
}
