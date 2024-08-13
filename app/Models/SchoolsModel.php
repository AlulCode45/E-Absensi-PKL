<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolsModel extends Model
{
    use HasFactory;
    protected $table = 'schools';
    protected $guarded = ['id'];
    public $timestamps = false;

    function students(): HasMany
    {
        return $this->hasMany(StudentsModel::class, 'school_id', 'id');
    }
}