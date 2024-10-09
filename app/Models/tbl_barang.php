<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_barang extends Model
{
    protected $table = 'tbl_barang'; // Nama tabel di database
    protected $primaryKey = 'idBarang';
    protected $fillable = [
        'namaBarang',
        'hargaBarang', 
        'stokBarang', 
        'fotoBarang'
        // Kolom yang dapat diisi
    ]; 
    public $timestamps = false;
}

