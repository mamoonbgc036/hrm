<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        activity('login')
            ->causedBy($event->user->id)
            ->performedOn(new User())
            ->withProperties([
                'login_ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
            ])
            ->log('Success');
    }
}
