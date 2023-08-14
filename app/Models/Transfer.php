<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'destinasi_id',
        'status',
        'nominal',
        'tanggal',
        'order_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $table = 'transfers';


    public function destinasi() //destinasi_id
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id', 'id');
    }
}
