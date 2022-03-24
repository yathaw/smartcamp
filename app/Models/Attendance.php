<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['date', 'status', 'remark', 'student_id', 'schedule_id', 'user_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
