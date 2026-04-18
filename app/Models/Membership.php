<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
     protected $fillable = [
        'user_id',
        'type_id',
        'start_date',
        'end_date',
    ];

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'type_id');
    }   
}
