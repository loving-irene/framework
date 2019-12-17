## 变更
- `index.php` 增加了一个测试方法 `fun2()` 用来进行数据库相关测试
- `index.php` 增加了 `use system/db`

和 `index.php` 一样，当我们的基本骨架搭建起来之后，你会慢慢发现，使用过程有点像正常的项目开发了。只需要在 `app` 文件下进行文件的新增、编辑即可，因为 1.2 版本框架功能还在扩充中，所以 `system` 文件夹下还有文件的新增和编辑，当框架功能固定之后，只需要编辑 `app` 一个文件夹即可。

### 详细说明
    <?php
    ...
    // 数据库测试方法
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
    
这些就是 `index.php` 中新增的全部内容，虽然 `system/db.php` 中使用了命名空间，这里能够这样（`new db()`）进行对象创建的原因在 1.1 中有过详细的解释说明。这里列举了主方法的使用示例，和实际的项目开发基本上已经一致了。

到这里，你应该发现，框架开发的重点并不在难，而是繁。只要走出了第一步，每天走一点，每天走一点，最终总是可以做出来的。