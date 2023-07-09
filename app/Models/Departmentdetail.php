<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Faculty;
use App\Models\University;
use App\Models\Language;
use App\Models\Department;

class Departmentdetail extends Model
{
    use HasFactory;
    protected $table = "department_detail";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($departmentdetail) {
            $departmentdetail->uuid = (string) Str::uuid();
        });
    }

    public function parentUniversity()
    {
        return $this->hasOne(University::class, 'uuid', 'university_id')->select('uuid', 'name_en');
    }

    public function parentFaculty()
    {
        return $this->hasOne(Faculty::class, 'uuid', 'faculty_id')->select('uuid', 'name_en');
    }

    public function parentDepartment()
    {
        return $this->hasOne(Department::class, 'uuid', 'department_id')->select('uuid', 'name_en');
    }

    public function parentLanguage()
    {
        return $this->hasOne(Language::class, 'uuid', 'language_id')->select('uuid', 'name_en');
    }

    public function getUniversities()
    {
        return University::where('uuid', $this->university_id)->get()->toArray();
    }

    public function getFaculties()
    {
        return Faculty::where('uuid', $this->faculty_id)->get()->toArray();
    }

    public function getDepartments()
    {
        return Department::where('uuid', $this->department_id)->get()->toArray();
    }

    public function getLanguages()
    {
        return Languages::where('uuid', $this->language_id)->get()->toArray();
    }
}

