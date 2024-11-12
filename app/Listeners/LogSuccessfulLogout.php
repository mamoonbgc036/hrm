<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        activity('logout')
            ->causedBy($event->user->id)
            ->performedOn(new User())
            ->withProperties([
                'login_ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
            ])
            ->log('Success');
    }
}
