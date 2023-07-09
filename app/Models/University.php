<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str class

class University extends Model
{
    use HasFactory;

    protected $table = "university";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($university) {
            $university->uuid = (string) Str::uuid();
        });
    
    }
}


