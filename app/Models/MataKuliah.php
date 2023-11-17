<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'matkul';

    protected $fillable = [
        'matkul',
    ];

    public $timestamps = false;

    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }
}
