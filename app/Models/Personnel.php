<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }
    public function manager()
    {
        return $this->belongsTo(Personnel::class,'manager_id','id')->withDefault();
    }
    public function area()
    {
        return $this->belongsTo(Area::class)->withDefault();
    }

    public function loge()
    {
        return $this->belongsTo(Loge::class)->withDefault();
    }

    public function payment()
    {
        return $this->belongsTo(PaymentSource::class,'payment_source_id')->withDefault();
    }

    public function section()
    {
        return $this->belongsTo(Section::class)->withDefault();
    }

    public function forecasts()
    {
        return $this->belongsToMany(Day::class, 'forecasts', 'personnel_id', 'day_id');
    }

    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
}
