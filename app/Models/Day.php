<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Day extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return Jalalian::fromFormat('Ymd', $this->attributes['name'])->format('%A, %d %B');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class)->orderBy('enter');
    }

    public function forecasts()
    {
        return $this->belongsToMany(Personnel::class, 'forecasts', 'day_id', 'personnel_id');
    }
}
