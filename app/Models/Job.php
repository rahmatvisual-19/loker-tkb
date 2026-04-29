<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Satu Loker dimiliki oleh Satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Satu Loker memiliki banyak Pelamar
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}