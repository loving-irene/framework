<?php
namespace app\admin\controller;

use app\admin\controller\test;
use system\db;

class index
{
    /**
     * 方法1
     */
    public function fun1()
    {
        $obj = new test;
        vde($obj->fun1());
    }

    public function fun2()
    {
        $db = new db();
        $pdo = $db->table('bjy_sites')->where('id = 1')->field('*')->find();
        vde($pdo->fetch());
    }
}