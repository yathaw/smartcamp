<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjecttype extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'otherlanguage', 'school_id'];

    public function curricula()
    {
        return $this->hasOne('App\Models\Curriculum');
    }

    public function grades()
    {
        return $this->belongsToMany('App\Models\Grade', 'curricula');
    }
}
