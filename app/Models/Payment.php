<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'email',
        'no_telp',
        'qty',
        'total',
        'status',
        'tanggal',
        'user_id',
        'destinasi_id',
        'status_tiket'
    ];

    public function destinasi() //destinasi_id
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id', 'id');
    }

    public function user()  //user_id
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
