<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['type', 'status', 'sorting', 'grade_id', 'subject_id', 'subjecttype_id', 'school_id'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function subjecttype()
    {
        return $this->belongsTo('App\Models\Subjecttype');
    }

    public function syllabus()
    {
        return $this->hasOne('App\Models\Syllabus');
    }

    public function teachersegment()
    {
        return $this->hasOne('App\Models\Teachersegment');
    }
}
