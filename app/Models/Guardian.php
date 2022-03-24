<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['relatiionship', 'phone', 'occupation', 'user_id', 'staff_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}
