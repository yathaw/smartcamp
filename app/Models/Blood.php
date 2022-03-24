<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blood extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name'];

    public function staff()
    {
        return $this->hasOne('App\Models\Staff');
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }
}
