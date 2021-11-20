<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanProdukModel extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $primaryKey = 'id_satuanproduk';
    public $timestamps = true;
    protected $table = 'satuan_produk';
}
