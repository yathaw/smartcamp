<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['title', 'date', 'starttime', 'endtime', 'color', 'batch_id', 'teachersegment_id', 'staff_id', 'school_id', 'scheduletype_id'];

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function teachersegment()
    {
        return $this->belongsTo('App\Models\Teachersegment');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function scheduletype()
    {
        return $this->belongsTo('App\Models\Scheduletype');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }
}
