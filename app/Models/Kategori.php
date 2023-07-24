<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = "kategoris";
    protected $fillable = [
        'kode',
        'nama',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    //relations
    public function destinasi()
    {
        return $this->hasMany(Destinasi::class, 'kategori_id');
    }
    public function kuliner()
    {
        return $this->hasMany(Kuliner::class, 'kategori_id');
    }
    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class);
    }
}
