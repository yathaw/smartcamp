<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable=['invoiceno','admitted', 'ay', 'pc', 'pcy', 'ppc', 'acyear1', 'dc', 'acyear2', 'desscription', 'lastattendance', 'approvedate', 'student_id', 'school_id', 'staff_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }

}
