<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $table = 'kategori';
}
