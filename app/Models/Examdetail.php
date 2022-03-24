<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examdetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['starttime', 'endtime', 'exam_id', 'syllabus_id', 'school_id', 'user_id'];

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    public function syllabus()
    {
        return $this->belongsTo('App\Models\Syllabus');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }
}