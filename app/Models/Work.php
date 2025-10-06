<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Work extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'end_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function applicants()
{
    return $this->hasMany(Applicant::class);
}

    /**
     * Check if the job is currently active
     */
    public function isActive()
    {
        return $this->status === 'active' && $this->end_date >= now()->toDateString();
    }

    /**
     * Get the display status (considers both status field and end_date)
     */
    public function getDisplayStatus()
    {
        if ($this->status !== 'active') {
            return 'inactive';
        }
        
        return $this->end_date >= now()->toDateString() ? 'active' : 'expired';
    }

    /**
     * Get the CSS class for status display
     */
    public function getStatusColorClass()
    {
        $status = $this->getDisplayStatus();
        
        return match($status) {
            'active' => 'bg-green-100 text-green-800',
            'expired' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
