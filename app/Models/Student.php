<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['nativename', 'gender', 'dob', 'address', 'status', 'file', 'bio', 'fathername', 'fatherphone', 'fatheremail', 'fatheroccupation', 'mothername', 'motherphone', 'motheremail', 'motheroccupation', 'ferry', 'lunchbox', 'religion_id', 'blood_id', 'school_id', 'staff_id', 'user_id'];

    public function religion()
    {
        return $this->belongsTo('App\Models\Religion');
    }

    public function blood()
    {
        return $this->belongsTo('App\Models\Blood');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }

    public function guardians()
    {
        return $this->belongsToMany('App\Models\Guardian');
    }

    public function studentsegments()
    {
        return $this->hasMany('App\Models\Studentsegment');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }
}
