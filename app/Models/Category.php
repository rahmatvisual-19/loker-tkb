<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Satu Kategori memiliki Banyak Loker
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
