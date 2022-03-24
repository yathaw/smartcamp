<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['codeno', 'price', 'pricetype', 'startdate', 'enddate', 'starttime', 'endtime', 'period_id', 'grade_id', 'user_id', 'school_id','currency_id'];

    public function period()
    {
        return $this->belongsTo('App\Models\Period');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Batch');
    }

    public function teachersegment()
    {
        return $this->hasOne('App\Models\Teachersegment');
    }
}
