<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable
{
    use HasFactory;
    protected  $table = 'role_admins';
    protected $fillable = [
        'username',
        'password',
        'created_at',
        'updated_at',
    ];
    protected $guarded = ['id'];

    public function getAuthIdentifierName()
    {
        return 'id'; // Ganti dengan nama kolom yang digunakan sebagai identifier
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}