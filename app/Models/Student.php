<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['registerdate', 'medicalproblem', 'psn', 'nativename', 'gender', 'dob', 'address', 'status', 'bio', 'academicawards', 'otherinterest', 'ferry', 'lunchbox', 'otherallergy', 'foodallergy', 'medicalallergy', 'medicalneeds', 'dormitory', 'lmir', 'tc', 'pcm', 'idb', 'idf', 'gbc', 'religion_id', 'grade_id', 'country_id', 'blood_id', 'sport_id', 'school_id', 'staff_id', 'user_id'];

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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function sport()
    {
        return $this->belongsTo('App\Models\Sport');
    }

    public function guardians()
    {
        return $this->belongsToMany('App\Models\Guardian');
    }

    public function studentsegments()
    {
        return $this->hasMany('App\Models\Studentsegment')->orderBy('batch_id', 'desc');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function getAttendance($model, $studentid, $date)
    {
        return $model::where([
                ['date', '=', $date],
                ['student_id', '=', $studentid]
            ])
            ->first();
    }

    public function getAttendance_status($model, $studentid, $batchid, $status)
    {
        return $model::where([
                ['batch_id', '=', $batchid],
                ['student_id', '=', $studentid],
                ['status', '=', $status]
            ])
            ->count();
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function getExamresult($model, $examdetailid, $studentid) {

    return $model::where([
                ['examdetail_id', '=', $examdetailid],
                ['student_id', '=', $studentid]
            ])
            ->first();
    }

    public function transfer()
    {
        return $this->hasOne('App\Models\Transfer');
    }

    public function getPaidpayments($model, $studentid) {

        return $model::where([
                ['student_id', '=', $studentid]
            ])
            ->pluck('package_id')
            ->toArray();
    }

    
}
