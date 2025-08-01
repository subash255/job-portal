<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    
    
}
