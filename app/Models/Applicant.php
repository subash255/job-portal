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
        'portfolio_url',
        'expected_salary',
        'availability_date',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'availability_date' => 'date',
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

    // Optional accessor for resume URL
    public function getResumeUrlAttribute()
    {
        return $this->resume ? asset('storage/' . $this->resume) : null;
    }
}
