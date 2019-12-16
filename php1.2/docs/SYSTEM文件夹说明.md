#### system文件夹说明

##### 增加了命名空间 `system`
    
    <?php
    namespace system;

只增加了一行，达到的效果是加载后的文件由根域变成了 `system` 域

##### 新增了路径常量

    <?php
    ...
    define('VIEW',APP.'admin/view/');
    define('MODEL',APP.'admin/model/');

这里的常量主要在应用文件夹 `app` 的控制器中（此demo中，使用新建的控制器 `html.php` 来演示）