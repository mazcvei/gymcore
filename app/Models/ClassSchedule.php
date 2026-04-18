<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $table = 'class_schedules';
     protected $fillable = [
        'class_id',
        'date',
        'start_time',
        'end_time',
        'max_capacity',
        'current_reservations'
    ];

    public function trainingClass()
    {
        return $this->belongsTo(GymClass::class, 'class_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'schedule_id');
    }

    protected $appends = ['start_time_formatted', 'end_time_formatted'];

    public function getStartTimeFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->start_time)->format('H:i');
    }

    public function getEndTimeFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->end_time)->format('H:i');
    }

    public function gymclass()
    {
        return $this->belongsTo(GymClass::class, 'class_id');
    }
}
