<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Interest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name'];

    public function softwareanalytics()
    {
        return $this->belongsToMany('App\Models\Softwareanalytic')
                    ->withPivot('school_id');

    }
}
