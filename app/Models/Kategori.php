<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

    # Set Primary Key tabel kategori
    protected $primaryKey = 'id_kategori';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = false;
    protected $table = 'kategori';
}
