<?php

// 引入路由解析文件
include('./system/url.php');
// 引入常量定义文件
include('./system/constant.php');
// 引入框架函数库
include('./system/function.php');

// 解析数组拿到路径
\system\url::analyse($_SERVER);

$obj = new \system\url();

// 加载指定文件
include(APP.$obj->get('path').EXT);
include(APP.'admin/controller/test.php');

// 加载第三方库文件
include(VENDOR.'autoload.php');


$class_name = $obj->get('controller');
$func = $obj->get('func');

$namesapce = 'app\admin\controller\\'.$class_name;
$app = new $namesapce;
$app->$func();