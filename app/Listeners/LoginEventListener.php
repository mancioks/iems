<?php

namespace App\Listeners;

use App\Services\Logger;
use Illuminate\Auth\Events\Login;

class LoginEventListener
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        Logger::log('login', $event->user->email);
    }
}
