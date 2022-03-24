<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['sortname','name', 'phonecode'];

    public function states()
    {
        return $this->hasMany('App\Models\State');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grade');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\Staff');
    }

    public function currency()
    {
        return $this->hasOne('App\Models\Currency');
    }
}
