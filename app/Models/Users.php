<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    # Semua kolom di tabel users, dapat melakukan operasi crud
    protected $guarded = [];
    # Set Primary Key tabel users
    protected $primaryKey = 'id_users';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
}
