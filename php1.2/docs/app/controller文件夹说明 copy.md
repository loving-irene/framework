## index.php文件

**`index.php` 新增命名空间 `app\admin\controller`**
>对照文件目录，可以发现命名空间和框架的目录结构一致。这样设计的目的，是为了方便使用，能够根据命名空间找到对应的文件，这一点在工程实践中非常有效。

**`index.php` 使用 `use` 引入了新的类**

    <?php
    ...
    use app\admin\controller\test;
    class index
    {
        /**
        * 方法1
        * 方法体和 1.0 demo 不一样
        */
        public function fun1()
        {
            $obj = new test;
            vde($obj->fun1());
        }
    }

#### Use的使用

`use` 搭配命名空间使用，其所起到的作用就是给 `qulified name/full qulified name` 起别名，将一个写法 `$obj = new app\admin\controller\test` 变成 `$obj = new test`。如上诉例子一样，`fun1` 中之所以能够如下使用

    <?php
    ...
    public function fun1()
    {
        $obj = new test;
        vde($obj->fun1());
    }

其前置条件是，在 `index.php` 文件开头作了如下动作

    <?php
    ...
    use app\admin\controller\test;

进一步往下，`use` 同样有前提条件，被 `use` 的类必须先被引入，正如我们在 INDEX.PHP 文件说明中所指明的那样

    **index.php**
    <?php
    ...
    include(APP.'admin/controller/test.php');

这里 `include(APP.'admin/controller/test.php');` 的意义就是为了应用文件夹 `app` 下的 `index.php` 中能够 `use app\admin\controller\test`。所以，在 INDEX.PHP 文件说明中我说

>`include(APP.'admin/controller/test.php');`
>配合应用控制器 `index.php` 中的 `use` 使用，放在控制器说明中说明
这里的 `include(APP.'admin/controller/test.php');` 只是 `demo` 中的写法，任何非 `demo` 的框架中都要使用自动加载，毕竟生产框架需要加载的类文件往往都是几十上百的数量。

---
## test.php文件
- `app\admin\controller` 文件夹下新增了一个文件 `test.php`
>到这里，项目应用是如何从0开始扩展的，其实已经能够看出一个雏形，需要做的只是根据业务需求，在 `controller` 文件夹下创建更多的文件即可。

---
## html.php文件
这里的 `html.php` 文件，用来创建相应逻辑，用来演示，返回值为 `html` 文件时如何处理。配合 `view` 文件夹使用，具体的 `html` 文件存放在 `view` 文件夹下。