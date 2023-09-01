<?php

namespace App\Models;

use App\Models\Wilayah;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Destinasi extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    // protected $appends = ['sisa_kuota'];
    protected $fillable = [
        'nama',
        'alamat',
        'foto',
        'foto2',
        'foto3',
        'foto4',
        'deskripsi',
        'kategori_id',
        'wilayah_id',
        'status',
        'latitude',
        'longitude',
        'maps',
        'operasional',
        'pelayanan',
        'harga',
        'kuota'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];
    

    protected $table = 'destinasis';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }


    // public function getSisaKuotaPerDay($day)
    // {
    //     $day = Str::lower($day);$totalTerjual = $this->payments()
    //         ->where('status', 'success')
    //         ->whereDay($day, Carbon::now()->day)
    //         ->sum('qty');

    //     return $this->$day - $totalTerjual;
    // }

    // public function getSisaKuotaAttribute()
    // {
    //     $tanggalSekarang = now()->toDateString();$totalTerjualHariIni = $this->payments()
    //     ->whereDate('created_at', $tanggalSekarang)
    //     ->where('status', 'success')
    //     ->sum('qty');

    //     return $this->kuota - $totalTerjualHariIni;
    // }


}

    