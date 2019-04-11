<?php

namespace A2htray\GDBChado;

use A2htray\GDBChado\Events\InitDBEvent;
use A2htray\GDBChado\Events\UpdateDBEvent;
use A2htray\GDBChado\Listeners\UpdateDBListener;
use A2htray\GDBChado\Listeners\InitDBListener;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Server
{
    private $version;
    private $isInstalled;
    private $checkInstalled;
    private $eventDispatcher;

    public const EVENT_INIT_DB = 'server.init.chado';
    public const EVENT_UPDATE_DB = 'server.update.chado';

    public $message = '';

    private $events = [
        self::EVENT_INIT_DB => InitDBEvent::class,
        self::EVENT_UPDATE_DB => UpdateDBEvent::class,
    ];

    private $listeners = [
        self::EVENT_INIT_DB => InitDBListener::class,
        self::EVENT_UPDATE_DB => UpdateDBListener::class
    ];

    public function __construct(array $signals, string $version='1.31')
    {
        // 参数 Signals 必须包含键 checkInstalled，由客户端指定检查 Chado 是否安装的方法
        // 该方法返回 bool 值
        assert(isset($signals['checkInstalled']),
            'gdb-chado : Signals must contain the key \'checkInstalled\'' . PHP_EOL);

        $this->setSignals($signals['checkInstalled']);
        $this->isInstalled = call_user_func($this->checkInstalled);

        $this->version = $this->version ?? $version;

        $this->eventDispatcher = new EventDispatcher();

        $this->eventDispatcher->addListener(
            self::EVENT_INIT_DB,
            [new $this->listeners[self::EVENT_INIT_DB](), 'handle']
        );

        $this->eventDispatcher->addListener(
            self::EVENT_UPDATE_DB,
            [new $this->listeners[self::EVENT_UPDATE_DB](), 'handle']
        );
    }

    public function setListenerAndEvent(string $eventName, $listener, $event)
    {
        $eventNames = [self::EVENT_INIT_DB, self::EVENT_UPDATE_DB];
        assert(in_array($eventName, $eventNames),
            'gdb-chado : event name must in array [' . implode(',', $eventNames) . ']');

        $this->events[$eventName] = $event;
        $this->listeners[$eventName] = $listener;
    }

    public function initdb()
    {
        if (!$this->isPgsqlDriver()) {
            $this->message = 'DB driver must be pgsql';
        }

        // 如果已安装任意版本的 Chado，则不可再使用 initdb 方法
        // 改使用 updatedb 方法
        if ($this->isInstalled) {
            $this->message = 'Chado has been installed';
            Log::info('gdb-chado', ['Chado has been installed']);
            return null;
        }

        $sql = file_get_contents(__DIR__ . '/../database/chado.' . $this->version . '.sql');

        Log::debug('gdb-chado', [DB::getDefaultConnection()]);

        DB::beginTransaction();
        try {
            DB::unprepared($sql);
            DB::commit();
        } catch (\Exception $e) {
            Log::warning('gdb-chado', [$e]);
            DB::rollBack();
        }

        $this->eventDispatcher->dispatch(
            self::EVENT_INIT_DB,
            new $this->events[self::EVENT_INIT_DB]($this)
        );
    }

    public function updatedb()
    {
        // 方法调用后直接报错，更新逻辑目前用不到
        assert(false, 'Just support Chado 1.31');
        $this->eventDispatcher->dispatch(
            self::EVENT_UPDATE_DB,
            new $this->events[self::EVENT_UPDATE_DB]($this)
        );
    }

    private function setSignals(\Closure $checkInstalled)
    {
        $this->checkInstalled = $checkInstalled;
    }

    private function isPgsqlDriver() : bool
    {
        return env('DB_CONNECTION') == 'pgsql';
    }
}