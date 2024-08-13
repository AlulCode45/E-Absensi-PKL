<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $guarded = ['id'];
    public $timestamps = false;

    function school()
    {
        return $this->belongsTo(SchoolsModel::class, 'school_id', 'id');
    }

    function devision()
    {
        return $this->belongsTo(DevisionModel::class, 'devision_id', 'id');
    }

    function absents()
    {
        return $this->hasMany(AbsentsModel::class, 'student_id', 'id');
    }
}