<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['voucherno', 'amount', 'photo', 'date', 'package_id', 'student_id', 'staff_id', 'school_id', 'section_id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
}
