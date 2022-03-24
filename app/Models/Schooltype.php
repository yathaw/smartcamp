<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schooltype extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name'];

    public function school()
    {
        return $this->hasOne('App\Models\School');
    }
}
