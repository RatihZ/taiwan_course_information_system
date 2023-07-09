<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\University;
use App\Models\City;

class Address extends Model
{
    use HasFactory;

    protected $table = "address";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($address) {
            $address->uuid = (string) Str::uuid();
        });
    }

    public function parentUniversity()
    {
        return $this->hasOne(University::class, 'uuid', 'university_id')->select('uuid', 'name_en');
    }

    public function parentCity()
    {
        return $this->hasOne(City::class, 'uuid', 'city_id')->select('uuid', 'name_en');
    }

    public function parentCountry()
    {
        return $this->hasOne(Country::class, 'uuid', 'country_id')->select('uuid', 'name_en');
    }

    public function getUniversities()
    {
        return University::where('uuid', $this->university_id)->get()->toArray();
    }

    public function getCities()
    {
        return City::where('uuid', $this->city_id)->get()->toArray();
    }

    public function getCountries()
    {
        return Country::where('uuid', $this->country_id)->get()->toArray();
    }
}
