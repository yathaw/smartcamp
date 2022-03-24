<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable=['name', 'sorting', 'school_id'];

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function positions()
    {
        return $this->hasMany('App\Models\Position');
    }
}
