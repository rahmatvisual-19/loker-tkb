<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Mengizinkan semua field untuk diisi melalui mass assignment
    protected $guarded = ['id'];

    // Tambahkan casting agar JSON otomatis diubah jadi Array di PHP
    protected $casts = [
        'work_experiences' => 'array',
    ];

    // Relasi balik ke tabel Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}