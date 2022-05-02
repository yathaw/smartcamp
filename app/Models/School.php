<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['codeno', 'name', 'logo', 'coverphoto', 'certificate', 'about', 'mottoes', 'established', 'facilities', 'address', 'studentamount', 'city_id', 'schooltype_id', 'socaillink'];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function schooltype()
    {
        return $this->belongsTo('App\Models\Schooltype');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }

    public function grades()
    {
        return $this->belongsToMany('App\Models\Grade')
                    ->withPivot('id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function departments()
    {
        return $this->hasMany('App\Models\Department');
    }

    public function positions()
    {
        return $this->hasMany('App\Models\Position');
    }

    public function periods()
    {
        return $this->hasMany('App\Models\Period');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    public function syllabi()
    {
        return $this->hasMany('App\Models\Syllabus');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package');
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Batch');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    public function exams()
    {
        return $this->hasMany('App\Models\Exam');
    }

    public function examdetails()
    {
        return $this->hasMany('App\Models\Examdetail');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function teachersegment()
    {
        return $this->hasOne('App\Models\Teachersegment');
    }

    public function socailmedias()
    {
        return $this->belongsToMany('App\Models\Socialmedia')
                    ->withPivot('link')
                    ->withTimestamps();
    }

    public function softwareanalytic()
    {
        return $this->hasMany('App\Models\Softwareanalytic');
    }

    public function scheduletype()
    {
        return $this->hasOne('App\Models\Scheduletype');
    }

    public function holiday()
    {
        return $this->hasOne('App\Models\Holiday');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }

    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan')
                    ->withPivot('user_id','status')
                    ->withTimestamps();
    }

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function recordings()
    {
        return $this->hasMany('App\Models\Recording');
    }
}
