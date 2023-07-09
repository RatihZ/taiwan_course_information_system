<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str class
use App\Models\Country;

class City extends Model
{
    public $table = "city";
    use HasFactory;
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($city) {
            $city->uuid = (string) Str::uuid();
        });
    }

      public function parentCountry()
    {
        return $this->hasOne(Country::class, 'uuid', 'country_id')->select('uuid', 'name_en');
    }

    public function getCountries()
    {
        return Country::where('uuid', $this->country_id)->get()->toArray();
    }
}

