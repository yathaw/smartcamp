<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name'];

    public function curricula()
    {
        return $this->hasMany('App\Models\Curriculum')->orderBy('id', 'ASC');
    }

    public function schools()
    {
        return $this->belongsToMany('App\Models\School')
                    ->withPivot('id');
    }

    public function section()
    {
        return $this->hasOne('App\Models\Section');
    }

    public function syllabi()
    {
        return $this->hasManyThrough(Syllabus::class, Curriculum::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Curriculum::class);
    }

    public function subjecttypes()
    {
        return $this->belongsToMany('App\Models\Subjecttype', 'curricula')
                    ->groupBy('curricula.grade_id', 'curricula.subjecttype_id');
    }

    public function gradebatch()
    {
        return $this->hasOneThrough(Batch::class, Section::class);
    }
}
