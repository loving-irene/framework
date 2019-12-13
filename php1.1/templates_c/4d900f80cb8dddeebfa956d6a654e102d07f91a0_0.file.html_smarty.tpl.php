<?php
/* Smarty version 3.1.34-dev-7, created on 2019-12-13 03:25:06
  from 'C:\userful\phpstudy\PHPTutorial\WWW\framework\php1.1\app\admin\view\index\html_smarty.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5df304925b23b8_73386942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d900f80cb8dddeebfa956d6a654e102d07f91a0' => 
    array (
      0 => 'C:\\userful\\phpstudy\\PHPTutorial\\WWW\\framework\\php1.1\\app\\admin\\view\\index\\html_smarty.tpl',
      1 => 1576207504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5df304925b23b8_73386942 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\userful\\phpstudy\\PHPTutorial\\WWW\\framework\\php1.1\\vendor\\smarty\\smarty\\libs\\plugins\\function.counter.php','function'=>'smarty_function_counter',),));
?>
<html>
<head>
    <title>A test</title>
</head>
<body>
<h1>标题</h1>

<div><?php echo $_smarty_tpl->tpl_vars['number']->value;?>
</div>
<div><?php echo smarty_function_counter(array('start'=>0,'skip'=>2),$_smarty_tpl);?>
</div>
<div><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
</div>
<div><?php echo $_smarty_tpl->tpl_vars['array']->value;?>
</div>
<div><?php echo $_smarty_tpl->tpl_vars['obj']->value;?>
</div>
</body>
</html><?php }
}
