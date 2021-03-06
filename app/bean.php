<?php
return [
    \App\Model\Logic\DemoLogic::class => [
        [
            'dDname',
            12,
            '${App\Model\Data\DemoData}'
        ],
        'definitionData' => 'definitionData...'
    ],

    'logger'     => [
        'flushRequest' => false,
        'enable'       => false,
    ],
    'httpServer' => [
        'class'    => \Swoft\Http\Server\HttpServer::class,
        'port'     => 88,
        'listener' => [
            'rpc' => \bean('rpcServer')
        ],
        'on'       => [
            \Swoft\Server\Swoole\SwooleEvent::TASK   => \bean(\Swoft\Task\Swoole\TaskListener::class),
            \Swoft\Server\Swoole\SwooleEvent::FINISH => \bean(\Swoft\Task\Swoole\FinishListener::class)
        ],
        'setting'  => [
            'task_worker_num'       => 1,
            'task_enable_coroutine' => true
        ]
    ],
    'user'       => [
        'class'   => \Swoft\Rpc\Client\Client::class,
        'host'    => '127.0.0.1',
        'port'    => 18307,
        'setting' => [
            'timeout'         => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout'   => 10.0,
            'read_timeout'    => 0.5,
        ],
        'packet'  => \bean('rpcClientPacket')
    ],
    'user.pool'  => [
        'class'  => \Swoft\Rpc\Client\Pool::class,
        'client' => bean('user')
    ],
    'rpcServer'  => [
        'class' => \Swoft\Rpc\Server\ServiceServer::class,
    ],
];