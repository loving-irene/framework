<?php

namespace app\api\controller;

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;

class log
{
    /**
     * 测试方法
     */
    public function test()
    {
        // $log = new Logger('name');
        // $log->pushHandler(new StreamHandler(RUNTIME.'log/my.log'));

        // $log->pushProcessor(new WebProcessor($_SERVER));
        // $log->pushProcessor(new IntrospectionProcessor());
        // $log->pushProcessor(new MemoryUsageProcessor());

        // add records to the log
        // $log->warning('Foo');
        // $log->error('Bar');
        // $log->info('message');
        // $log->debug('debug 100');
        // $log->notice('notice');
        // $log->critical('critical');
        // $log->alert('alert');
        // $log->emergency('emergency');

        echo 111;
    }

    /**
     * 读取日志文件
     */
    public function read()
    {
        $redis = new \Redis();

        $file = \file(RUNTIME.'log/my.log');

        $pattern = '/\[2020-01-08.*/';
        $arr = \preg_grep($pattern,$file);

        vd($file);
        vde($arr);
    }
}