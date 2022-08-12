<?php

namespace App\Listeners\event;

use App\Events\event\SendEmailEvent;
use App\Mail\EventCreationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
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
     * @param  \App\Events\SendMailEvent  $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {

        Mail::to($event->emailTo)->send(
            new EventCreationEmail($event->data)
        );
    }
}
