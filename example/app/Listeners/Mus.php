<?php

namespace App\Listeners;

use App\Events\Cus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Mus
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
     * @param  \App\Events\Cus  $event
     * @return void
     */
    public function handle(Cus $event)
    {
        dd("tyt govno " . $event->str);
    }
}
