<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['point', 'mark', 'comment', 'examdetail_id', 'student_id', 'school_id', 'user_id'];

    public function examdetail()
    {
        return $this->belongsTo('App\Models\Examdetail');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
