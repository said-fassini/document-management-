<?php

namespace App\Listeners;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RedirectIfAuthenticated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Authenticated $event)
    {
        $user = $event->user;

        switch ($user->role) {
            case 'President':
                return redirect('/president/dashboard')->send();
            case 'Bureau dOrdre':
                return redirect('/bo/home')->send();
            case 'Service':
                return redirect('/service/overview')->send();
            default:
                return redirect('/home')->send();
        }
    }
}
