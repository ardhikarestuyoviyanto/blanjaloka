<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemda extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    # Set Primary Key tabel users
    protected $primaryKey = 'id_pemda';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
    protected $table = 'pemda';
}
