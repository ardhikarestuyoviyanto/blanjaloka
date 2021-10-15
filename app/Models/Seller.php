<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    # Set Primary Key tabel penjual
    protected $primaryKey = 'id_penjual';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = true;
    protected $table = 'penjual';

}
