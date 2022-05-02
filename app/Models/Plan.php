<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'amount', 'duration'];

    public function schools()
    {
        return $this->belongsToMany('App\Models\School')->withPivot('user_id','status')->withTimestamps();
    } 
    
}