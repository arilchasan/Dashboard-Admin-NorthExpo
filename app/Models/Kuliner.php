<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kuliner extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    protected $table = 'kuliner';
    protected $fillable = [
        'nama_warung',
        'nama_kuliner',
        'deskripsi',
        'harga',
        'foto',
        'foto2',
        'foto3',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
