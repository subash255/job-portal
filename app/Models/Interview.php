<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
   protected $fillable = ['user_id', 'company_id', 'scheduled_at', 'meet_link', 'status'];

    protected $dates = ['scheduled_at'];


    public function candidate()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
