<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['grade_id', 'subject_id'];

    public function grade()
    {
    	return $this->belongsTo('App\Models\Grade');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Models\Subject');
    }
}
