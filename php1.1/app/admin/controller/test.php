<?php
namespace app\admin\controller;

class test{
    public function fun1()
    {
        vde(33);
    }

    public function html()
    {
        return include(VIEW.'index/test.html');
    }
}