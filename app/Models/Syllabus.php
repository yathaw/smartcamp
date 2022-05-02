<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Syllabus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['photo', 'file', 'type', 'curriculum_id', 'user_id', 'school_id'];

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function batches()
    {
        return $this->belongsToMany('App\Models\Batch')
                    ->withPivot('id');
    }

    public function studentsegments()
    {
        return $this->belongsToMany('App\Models\Studentsegment')
                    ->withPivot('id');
    }

    
}
