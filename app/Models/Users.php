<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_users',
        'nama_user',
        'email',
        'password',
        'no_telp',
        'alamat',
        'status',
        'google_id',
        'facebook_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    # Set Primary Key tabel users
    protected $primaryKey = 'id_users';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
    protected $table = 'users';

}