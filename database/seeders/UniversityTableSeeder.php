<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\University;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $universityRecords = [
            ['id'=>1,'uuid'=>1,'name_zh'=>'eng','name_en'=>'zh','phone'=>'892229292','email'=>'lala@gmail.com','fax'=>'test'],
        ];
        University::insert($universityRecords);
    }
}
