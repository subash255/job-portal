<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class QueuedVerifyEmail extends BaseVerifyEmail implements ShouldQueue
{
    use Queueable; 
    // No additional code needed. It inherits everything from VerifyEmail,
    // but now it implements ShouldQueue, so it will be queued.
}
