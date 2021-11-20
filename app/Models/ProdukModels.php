<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModels extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'id_produk';
    public $timestamps = true;
    protected $table = 'produk';
}
