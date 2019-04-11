<?php

namespace A2htray\GDBChado\Commands;

use A2htray\GDBChado\Server;
use Illuminate\Console\Command;

class InitChadoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gdb-chado:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init Chado 1.31 for your application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $server = new Server([
            'checkInstalled' => function () {
                return false;
            }
        ]);

        $server->initdb();

        echo $server->message . PHP_EOL;

        return 0;
    }
}
