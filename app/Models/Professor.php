<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Professor extends Model
{
    use HasFactory;
    protected $table = "professor";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($professor) {
            $professor->uuid = (string) Str::uuid();
        });
    }
}
