<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'komentars';
    protected $fillable = [
        'destinasi_id',
        'user_id',
        'komentar',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
