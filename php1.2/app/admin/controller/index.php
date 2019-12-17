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
        // insert
        $res = $db->table('bjy_users')->insert(['name'=>'name1','email'=>'email1']);
        // delete
        $res = $db->table('bjy_users')->where(['id'=>8])->delete();
        // update
        $res = $db->table('bjy_users')->where(['id'=>8])->update(['name'=>'name_new','email'=>'email_new']);
        // query one record
        $res = $db->table('bjy_users')->where(['id'=>8])->find();
        // query all record
        $res = $db->table('bjy_users')->where(['status'=>1])->select();
    }
}