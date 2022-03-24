<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Softwareanalytic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['reason', 'user_id', 'school_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function socialmedias()
    {
        return $this->belongsToMany('App\Models\Socialmedia')
                    ->withPivot('school_id');

    }

    public function interests()
    {
        return $this->belongsToMany('App\Models\Interest')
                    ->withPivot('school_id');
    }
}
