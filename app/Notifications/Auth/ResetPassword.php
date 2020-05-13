<?php

namespace App\Notifications\Auth;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;
}
