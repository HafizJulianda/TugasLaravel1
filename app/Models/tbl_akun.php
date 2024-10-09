<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class tbl_akun extends Authenticatable
{
    protected $table = 'tbl_akun'; // Nama tabel di database

    // Jika ada kolom yang dapat diisi secara massal
    protected $fillable = [
        'id',
        'username',
        'password',
        'no_wa',
        'email',
        'foto'
        // tambahkan kolom lain sesuai kebutuhan
    ];
}
