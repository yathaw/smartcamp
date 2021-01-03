<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'country_id'];

    public function country()
    {
    	return $this->belongsTo('App\Models\Country');
    }

    public function curricula()
    {
        return $this->hasMany('App\Models\Curriculum');
    }
}
