<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'startyear', 'endyear', 'school_id'];

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }
}
