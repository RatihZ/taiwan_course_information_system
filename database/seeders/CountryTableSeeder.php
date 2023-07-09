<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class countryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryRecords = [
            ['id'=>1,'uuid'=>1,'name_en'=>'eng','name_zh'=>'zh'],
        ];
        Country::insert($countryRecords);
    }
}
