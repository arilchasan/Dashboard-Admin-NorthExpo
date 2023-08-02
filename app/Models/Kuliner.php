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
        'alamat',
        'operasional',
        'deskripsi',
        'harga',
        'foto',
        'foto2',
        'foto3',
        'customer_service',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function komentar_kuliner()
    {
        return $this->hasMany(Komentar_Kuliner::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
