<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'sorting', 'department_id', 'school_id'];

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function commission()
    {
        return $this->hasOne('App\Models\Commission');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\Staff');
    }
}
