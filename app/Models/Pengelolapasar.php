<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengelolapasar extends Model
{
    use HasFactory;

    protected $guarded = [];

    # Set Primary Key tabel pengelola pasar
    protected $primaryKey = 'id_pengelolapasar';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
    protected $table = 'pengelolapasar';
}
