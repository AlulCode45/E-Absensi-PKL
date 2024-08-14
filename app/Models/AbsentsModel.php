<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AbsentsModel extends Model
{
    use HasFactory;
    protected $table = 'absents';
    protected $guarded = ['id'];
    public $timestamps = true;

    function students()
    {
        return $this->belongsTo(StudentsModel::class, 'student_id', 'id');
    }
}