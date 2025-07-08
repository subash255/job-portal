<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    

    protected $fillable = [
        'work_id',
        'applicant_id',
        'company_id',
        'status',
        'phone',
        'address',
        'experience',
        'education',
        'skills',
        'cover_letter',
        'resume',
        'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
