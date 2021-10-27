<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengendara extends Model
{
    use HasFactory;

    protected $guarded = [];

    # Set Primary Key tabel pengelola driver
    protected $primaryKey = 'id_driver';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
    protected $table = 'driver';
}
