#### constant.php文件变更
新增一行

    #定义了runtime的路径
    define('RUNTIME',ROOT.'runtime/');

根目录下新增一个文件夹 `runtime`，其下有一个子文件夹 `log` 用来存放日志，配置这样一个常量，为了方便指定路径

#### function.php文件变更
新增一个方法 `recordLog()`

    function recordLog($path = 'log/my.log')
    {
        $log = new \Monolog\Logger('name');
        $log->pushHandler(new \Monolog\Handler\StreamHandler(RUNTIME.'log/my.log'));

        $log->pushProcessor(new Monolog\Processor\WebProcessor($_SERVER));
        $log->pushProcessor(new Monolog\Processor\IntrospectionProcessor());
        $log->pushProcessor(new Monolog\Processor\MemoryUsageProcessor());

        // add records to the log
        // $log->warning('Foo');
        // $log->error('Bar');
        $log->info('message');
        // $log->debug('debug 100');
        // $log->notice('notice');
        // $log->critical('critical');
        // $log->alert('alert');
        // $log->emergency('emergency');
    }

单独拎出来方便在需要的地方进行调用。