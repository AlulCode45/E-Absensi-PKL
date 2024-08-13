<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisionModel extends Model
{
    use HasFactory;
    protected $table = 'devision';
    protected $guarded = ['id'];
    public $timestamps = false;

    function students()
    {
        return $this->belongsTo(StudentsModel::class, 'student_id', 'id');
    }
}