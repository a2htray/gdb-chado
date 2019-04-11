<?php

namespace A2htray\GDBChado\Events;

use A2htray\GDBChado\Server;
use Symfony\Component\EventDispatcher\Event;

class UpdateDBEvent extends Event
{
    private $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function getServer()
    {
        return $this->server;
    }
}