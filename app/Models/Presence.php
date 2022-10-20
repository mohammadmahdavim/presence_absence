<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = ['personnel_id', 'day_id', 'enter', 'exit','sum'];

    public function personnel()
    {
        return $this->hasOne(Personnel::class,'id','personnel_id')->withDefault();
    }

    public function day()
    {
        return $this->hasOne(Day::class,'id','day_id')->withDefault();
    }
}
