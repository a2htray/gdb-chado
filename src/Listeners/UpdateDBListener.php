<?php

namespace A2htray\GDBChado\Listeners;
use A2htray\GDBChado\Events\InitDBEvent;
use Illuminate\Support\Facades\Log;

class UpdateDBListener implements Listener
{
    /**
     * @param InitDBEvent $event
     */
    public function handle($event)
    {
        Log::info('gdb-chado : event \'update db\' had been handled' . PHP_EOL);
    }
}