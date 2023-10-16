<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


//Company Model that corresponds to Company DB Schema
class Company extends Model
{
    protected $fillable = [
        'company_id',
        'logo',
        'name',
        'city',
        'country',
        'webmail',
        'email',
        'employees',
        'funding_state',
        'industry',
        'technology',
        'trl',
        'business_model',
        'revenue_model',
        'funding_sources',
        'total_funding',
        'executive_summary',
    ];


}
