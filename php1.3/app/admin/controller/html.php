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

    /**
     * 使用 smarty 模板引擎
     */
    public function html_smarty()
    {
        $smarty = new \Smarty();
        $smarty->assign('number',40);
        $smarty->assign('array',[2,3,4]);
        return $smarty->display(VIEW.'index/html_smarty.tpl');
    }

}