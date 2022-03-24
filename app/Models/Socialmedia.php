<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socialmedia extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'socialmedias';

    protected $fillable=['name','logo'];

    public function schools()
    {
        return $this->belongsToMany('App\Models\School')
                    ->withPivot('link')
                    ->withTimestamps();
    }

    public function softwareanalytics()
    {
        return $this->belongsToMany('App\Models\Softwareanalytic')
                    ->withPivot('school_id');

    }
}
