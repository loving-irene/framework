#### index变更
新增

    $module = $obj->get('module');
    recordLog();

修改一行

    //原来
    $namesapce = 'app\admin\controller\\'.$class_name;
    //修改后
    $namesapce = 'app\\'.$module.'\controller\\'.$class_name;

#### 变更说明
只所以使用 `$module` 变量，主要是在 `app` 中新建了一个 `api` 文件夹，用来分流日志相关的逻辑，这样 `admin` 就有了一个同级的兄弟 `api`，使用默认方式 `'app\admin\controller\\'.$class_name` 就会出现问题，于是使用 `$module` 来进行替代。

`recordLog()` 是定义的日志函数，用于日志记录。