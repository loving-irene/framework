<?php
namespace app\admin\controller;

class html{

    /**
     * 返回HTML文件
     */
    public function html()
    {
        return include(VIEW.'index/test.html');
    }
}