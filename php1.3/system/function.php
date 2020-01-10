<?php

function vd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function vde($data)
{
    vd($data);
    exit;
}

function recordLog($path = 'log/my.log')
{
    $log = new \Monolog\Logger('name');
    $log->pushHandler(new \Monolog\Handler\StreamHandler(RUNTIME.'log/my.log'));

    $log->pushProcessor(new Monolog\Processor\WebProcessor($_SERVER));
    // $log->pushProcessor(new Monolog\Processor\IntrospectionProcessor());
    // $log->pushProcessor(new Monolog\Processor\MemoryUsageProcessor());

    // add records to the log
    // $log->warning('Foo');
    // $log->error('message');
    $log->info('message');
    // $log->debug('debug 100');
    // $log->notice('notice');
    // $log->critical('critical');
    // $log->alert('alert');
    // $log->emergency('emergency');

}