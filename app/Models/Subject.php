<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'subjecttype_id', 'school_id'];

    public function subjecttype()
    {
    	return $this->belongsTo('App\Models\Subjecttype');
    }

    public function school()
    {
    	return $this->belongsTo('App\Models\School');
    }

    public function curricula()
    {
        return $this->hasMany('App\Models\Curriculum');
    }
}
