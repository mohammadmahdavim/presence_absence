<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forecast extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class)->withDefault();
    }

    public function day()
    {
        return $this->belongsTo(Day::class)->withDefault();
    }
}
