<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_pasar',
        'nama_pasar',
        'alamat',
        'embbed_maps',
        'foto_pasar',
        'operasional_pasar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    #Set table
    protected $table = 'pasar';

    # Set Primary Key tabel pasar
    protected $primaryKey = 'id_pasar';
    # Insert dan Update otomatis kolom created_at dan update_at
    public $timestamps = false;
}
