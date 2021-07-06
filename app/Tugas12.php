<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas12 extends Model
{
    protected $table = 'tugas12';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'jabatan', 'umur', 'alamat', 'foto',
    ];
}
