<?php

namespace A2htray\GDBChado\Listeners;

use A2htray\GDBChado\Models\DB as ChadoDB;
use Illuminate\Support\Facades\Log;

class InitDBListener implements Listener
{
    public function handle($event)
    {
        Log::info('gdb-chado : event \'init db\' had been handled' . PHP_EOL);
        ChadoDB::updateOrCreate([
            'name' => 'local',
        ], [
            'description' => config(PACKAGE_PREFIX . '.site_description', ''),
        ]);
    }
}