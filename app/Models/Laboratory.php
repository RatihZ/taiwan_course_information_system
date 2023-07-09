<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Departmentdetail;
use App\Models\Professor;

class Laboratory extends Model
{
    use HasFactory;
    protected $table = "laboratory";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($laboratory) {
            $laboratory->uuid = (string) Str::uuid();
        });
    }

    public function parentDepartmentdetail()
    {
        return $this->hasOne(Departmentdetail::class, 'uuid', 'department_detail_id')->select('uuid');
    }

    public function parentProfessor()
    {
        return $this->hasOne(Professor::class, 'uuid', 'professor_id')->select('uuid', 'name_en');
    }

    public function getDepartmentdetails()
    {
        return Departmentdetail::where('uuid', $this->department_detail_id)->get()->toArray();
    }

    public function getProfessors()
    {
        return Professor::where('uuid', $this->professor_id)->get()->toArray();
    }

}
