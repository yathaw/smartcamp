<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studentsegment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['rollno', 'type', 'student_id', 'batch_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function syllabi()
    {
        return $this->belongsToMany('App\Models\Syllabus')
                    ->withPivot('id');
    }
}
