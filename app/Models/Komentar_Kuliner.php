<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar_Kuliner extends Model
{
   
    use HasFactory;
    protected $table = 'komentars_kuliners';
    protected $guarded = ['id'];
    protected $fillable = [
        'kuliner_id',
        'user_id',
        'komentar',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function kuliner()
    {
        return $this->belongsTo(Kuliner::class, 'kuliner_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
