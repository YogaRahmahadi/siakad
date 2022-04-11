<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'Email',
        'Alamat',
        'Tanggal_Lahir',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mahasiswa_matakuliah()
    {
        return $this->belongsToMany(Mahasiswa_Matakuliah::class);
    }
}