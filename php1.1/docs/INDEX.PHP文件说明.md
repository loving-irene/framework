#### index.php文件说明

与 `1.0 demo` 相比，如下部分作出了改变

    <?php
    ...
    include(APP.'admin/controller/test.php');
    ..
    $namesapce = 'app\admin\controller\\'.$class_name;
    $app = new $namesapce;

#### 说明

- `include(APP.'admin/controller/test.php');`
    >配合应用控制器 `index.php` 中的 `use` 使用，具体说明看控制器说明文件
- `$namesapce = 'app\admin\controller\\'.$class_name;$app = new $namesapce;`
    >因为引入了命名空间，在使用 `app` 下的类文件时，就需要按照命名空间的写法，可看 `命名空间.md`