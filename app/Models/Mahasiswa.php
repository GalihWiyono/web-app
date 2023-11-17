<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    
    protected $primaryKey = 'nim';

    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
    ];

    public $timestamps = false;

    public $incrementing = false;

    public function ujian()
    {
        return $this->hasMany(Ujian::class,'nim', 'nim');
    }
     
}
