<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addressRecords = [
            ['id'=>1,'uuid'=>1,'address_en'=>'No. 1, Section 4, Roosevelt Road 10617','address_zh'=>'罗斯福路四段1号 10617','university_id'=>1,'city_id'=>1,'country_id'=>1],
                ['id'=>2,'uuid'=>2,'address_en'=>'No. 64, Sec. 2, Zhinan Rd 11605','address_zh'=>'指南路二段64号 11605','university_id'=>2,'city_id'=>1,'country_id'=>1],
        ];
                Address::insert($addressRecords);
    }
}
