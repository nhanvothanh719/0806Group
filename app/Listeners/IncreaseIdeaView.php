<?php

namespace App\Listeners;

use App\Events\ViewIdeaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IncreaseIdeaView
{
    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ViewIdeaEvent  $event
     * @return void
     */
    public function handle(ViewIdeaEvent $event)
    {
        $idea = $event->idea;
        //Auto increase without session
        $idea->increment('view_count');
    }
}
