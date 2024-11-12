<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFailedLogin
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
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        activity('login')
            ->causedBy($event->user->id ?? null)
            ->performedOn(new User())
            ->withProperties([
                'login_ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
            ])
            ->log('Failed');
    }
}
