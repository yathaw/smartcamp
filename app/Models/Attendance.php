<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable=['date', 'status', 'remark', 'student_id', 'batch_id', 'user_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
