<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\Staff');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function section()
    {
        return $this->hasOne('App\Models\Section');
    }

    public function syllabus()
    {
        return $this->hasOne('App\Models\Syllabus');
    }

    public function package()
    {
        return $this->hasOne('App\Models\Package');
    }

    public function guardian()
    {
        return $this->hasOne('App\Models\Guardian');
    }

    public function teachersegment()
    {
        return $this->hasOne('App\Models\Teachersegment');
    }

    public function attendance()
    {
        return $this->hasOne('App\Models\Attendance');
    }

    public function exam()
    {
        return $this->hasOne('App\Models\Exam');
    }

    public function examdetail()
    {
        return $this->hasOne('App\Models\Examdetail');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function expense()
    {
        return $this->hasOne('App\Models\Expense');
    }

    public function batch()
    {
        return $this->hasOne('App\Models\Batch');
    }

    public function softwareanalytic()
    {
        return $this->hasOne('App\Models\Softwareanalytic');
    }
    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan')
                    ->withTimestamps();
    }
    
    public function scheduletype()
    {
        return $this->hasOne('App\Models\Scheduletype');
    }

    public function holiday()
    {
        return $this->hasOne('App\Models\Holiday');
    }
}
