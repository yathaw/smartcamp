<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'logo', 'coverphoto', 'certificate', 'about', 'mottoes', 'established', 'facilities'];

    public function subjects()
    {
    	return $this->hasMany('App\Models\Subject');
    }
}
