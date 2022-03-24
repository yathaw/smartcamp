<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'staff';

    protected $fillable=['workemail', 'gender', 'degree', 'nrc', 'dob', 'phone', 'address', 'status', 'joindate', 'leavedate', 'file', 'blood_id', 'religion_id', 'user_id','position_id', 'country_id'];

    public function blood()
    {
        return $this->belongsTo('App\Models\Blood');
    }

    public function religion()
    {
        return $this->belongsTo('App\Models\Religion');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function commissions()
    {
        return $this->hasMany('App\Models\Commission');
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\Teacher');
    }
    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function guardian()
    {
        return $this->hasOne('App\Models\Guardian');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }
    

    public function teachersegment()
    {
        return $this->hasOne('App\Models\Teachersegment');
    }

    public function schedule()
    {
        return $this->hasOne('App\Models\Schedule');
    }

}
