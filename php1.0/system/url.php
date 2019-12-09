<?php

/**
 * url解析器
 */

 class url
 {
    //  模块
    private static $module = 'admin';
    // 控制器
    private static $controller = 'index';
    // 方法
    private static $func = 'index';
    // 需要加载的文件路径
    private static $path = 'admin/controller/index';

    /**
     * 从超全局变量获取模块/控制器/方法
     */
    public static function analyse($data = [])
    {
        // module,controller,function  one of them exists
        if(!empty($data['PATH_INFO'])){
            $arr = explode('/',ltrim($data['PATH_INFO'],'/'));
            $num = count($arr);//module,controller,function,can exists or not

            switch($num){
                case 1:
                    self::$module = $arr[0];// the rest use index
                    self::$path = $arr[0].'/controller/index';
                break;
                case 2:
                    self::$module = $arr[0];
                    self::$controller = $arr[1];
                    self::$path = $arr[0].'/controller/'.$arr[1];
                break;
                case 3:
                    self::$module = $arr[0];
                    self::$controller = $arr[1];
                    self::$func = $arr[2];
                    self::$path = $arr[0].'/controller/'.$arr[1];
                break;
            }
        }
    }

    /**
     * get param
     */
    public function get($parse_name)
    {
        return self::$$parse_name;
    }

    /**
     * set param
     */
    public function set($parse_name,$parse_value)
    {
        self::$$parse_name = $parse_value;
    }
 }