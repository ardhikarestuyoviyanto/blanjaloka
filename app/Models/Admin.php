<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_admin',
        'nama',
        'email',
    ];

    protected $hidden = [
        'password',
    ];

    # Set Primary Key tabel users
    protected $primaryKey = 'id_admin';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
    protected $table = 'admin';
}
