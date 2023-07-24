<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillabel = [
        'id',
        'user_id',
        'destinasi_id',
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
    
    public function kategori()
    {
        return $this->belongsTo(Destinasi::class);
    }
    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    protected $guarded = ['id'];

    protected $table = 'wishlist';
}
