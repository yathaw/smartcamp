<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recording extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['photo', 'file', 'batch_id', 'user_id', 'school_id'];

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }
}