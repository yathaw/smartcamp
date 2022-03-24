<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teachersegment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['user_id', 'batch_id', 'staff_id', 'curriculum_id' ,'section_id', 'school_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

}
