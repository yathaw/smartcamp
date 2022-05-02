<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['codeno', 'name', 'bgcolor', 'txtcolor', 'subjecttype_id', 'section_id', 'user_id', 'school_id'];

    public function subjecttype()
    {
        return $this->belongsTo('App\Models\Subjecttype');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function syllabi()
    {
        return $this->belongsToMany('App\Models\Syllabus')
                    ->withPivot('id');
    }

    public function studentsegment()
    {
        return $this->hasOne('App\Models\Studentsegment');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    public function exams()
    {
        return $this->hasMany('App\Models\Exam');
    }

    public function teachersegment()
    {
        return $this->hasMany('App\Models\Teachersegment');
    }

    public function gradebatch()
    {
        return $this->hasOneThrough(
            Section::class,
            Grade::class
        );
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function recordings()
    {
        return $this->hasMany('App\Models\Recording');
    }
}
