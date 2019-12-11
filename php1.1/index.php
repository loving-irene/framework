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

$a = 10;
// 加载指定文件
include(APP.$obj->get('path').EXT);
use \app\admin\controller\index;

$class_name = $obj->get('controller');
$func = $obj->get('func');

$app = new $class_name();
$app->$func();