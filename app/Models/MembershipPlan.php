<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $table = 'membership_plans';  
    protected $fillable = [
        'name',
        'price',
        'dutation_days',
        'description',
        'is_popular',
        'features',
    ];
}
