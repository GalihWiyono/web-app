<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';

    protected $fillable = [
        'nim',
        'matkul_id',
        'tanggal_ujian',
        'nilai',
        'grade'
    ];

    public $timestamps = false;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'nim', 'nim');
    }

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
