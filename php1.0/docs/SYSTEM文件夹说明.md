##**目录结构**
-   system
    -   constant.php
    -   function.php
    -   url.php

####system文件夹用来放置构建框架环境的所有文件。

1.0 版本中只提供了路由解析功能，由 url.php 提供；constant.php 用来定义常量，function.php 则是框架级的函数库，与之对应，APP 中可以定义应用级的函数库，如果存在应用级的函数库，两者之间的关系是上下级。

####constant.php 和 function.php 与 url.php 分属于不同的功能划分。

从功能划分角度来看，constant.php 和 function.php 都是必须存在且唯一的，属于框架配置；url.php 属于框架功能，与它处于同一级别的还可以有很多其他的功能组件。

>功能组件这个概念，为构建超大型的项目提供了一种相当效率的解决思路。
不同的功能被抽象成一个个零部件，通过组合使用这些功能组件，完成业务需求。并且随着功能组件的不断增加，后续的需求研发会越发简单起来，主要的精力放在算法即可，用轮子就好，无需再花费相当的精力去造轮子。
这里要特别提及 composer，PHP 项目利用 composer 包管理器可以非常便利的利用别人造的轮子，基本上可以无痛的嵌入到自己的项目当中，使用别人的劳动成果是非常有效的一种方式，可以让我们更高效的利用自己的时间，提升效率。

---
##**Constant.php 说明**

    <?php
    // 后缀
    define('EXT','.php');

    // 路径
    define('ROOT',__DIR__.'/../');
    define('APP',ROOT.'app/');
    define('SYSTEM',ROOT.'system/');

1.0 版本只设置了上诉的常量，有两个部分：后缀和路径。

抽象的来看，路径可以看成一个必需的大类，其他是另一大类。

后缀只是包含在其他当中的一个细分，除了后缀之外，还可以定义同级的常量，比如操作系统、分隔符等等，存在很多与后缀同级的其他常量，设不设置以及如何设置，并没有定法。

在我看来，这完全取决于开发者（想怎么玩就怎么玩）。但是路径，是一个必备的部分，无论哪一个框架都必然存在，好处很明显，可以大大的简化路径书写时的复杂度（写的少），而且可以使用更具辨识度的名称。

---
##**Function.php 说明**

    <?php
    function vd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    function vde($data)
    {
        vd($data);
        exit;
    }

1.0 版本就设置了两个框架级函数，照搬 TP 的命名，vd 和 vde。

在 1.0 demo 中并不属于必需，列举在这里，只是说明，框架中会有一个或多个文件用来存放框架级的函数。

只所以说一个或多个，取决于框架的复杂程度以及开发者的喜好，列举 TP 的做法来进行一个对比，TP 中的框架级函数都在一个文件中，按类别进行了区分，写法如下：

    <?php

    //时间函数
    ...

    //文件函数
    ...

    //字符串函数
    ...

如果函数库丰富（几十上百个函数），即使是在 IDE 中，也是相当难使用的，尤其是在学习使用的时候。针对这种情况，可以进行进一步的划分。

如上，将时间函数放到一个文件当中，将文件函数放到另一个文件当中，每一个文件存放一个类别，可以更好的帮助定位，而且单个文件并不会很大。

究竟使用何种方式，还是取决于开发者的那灵光一闪。（很多的设计，并没有那么多的为什么，就像 Python 取名一样，作者喜欢看这个肥皂剧，所以就有了这么个名字，事实往往就是这么的平淡无奇）

---
##**Url.php 说明**

这里介绍 url.php 这个功能组件，下面会列举具体的代码，并详细说明为什么这样设计，以及是否还有其他的方案。

    <?php
    /**
     * url解析器
     */

     class url
     {
        //  模块
        private static $module = 'admin';
        // 控制器
        private static $controller = 'index';
        // 方法
        private static $func = 'index';
        // 需要加载的文件路径
        private static $path = 'admin/controller/index';

        /**
         * 从超全局变量获取模块/控制器/方法
         */
        public static function analyse($data = [])
        {
            // module,controller,function  one of them exists
            if(!empty($data['PATH_INFO'])){
                $arr = explode('/',ltrim($data['PATH_INFO'],'/'));
                $num = count($arr);//module,controller,function,can exists or not

                switch($num){
                    case 1:
                        self::$module = $arr[0];// the rest use index
                        self::$path = $arr[0].'/controller/index';
                    break;
                    case 2:
                        self::$module = $arr[0];
                        self::$controller = $arr[1];
                        self::$path = $arr[0].'/controller/'.$arr[1];
                    break;
                    case 3:
                        self::$module = $arr[0];
                        self::$controller = $arr[1];
                        self::$func = $arr[2];
                        self::$path = $arr[0].'/controller/'.$arr[1];
                    break;
                }
            }
        }

        /**
         * get param
         */
        public function get($parse_name)
        {
            return self::$$parse_name;
        }

        /**
         * set param
         */
        public function set($parse_name,$parse_value)
        {
            self::$$parse_name = $parse_value;
        }
     }

首先是功能模块的命名，也就是类名，准确的反应功能是非常重要的。
>好的命名，在使用过程中会减少许多无谓的消耗，能够从名字上判断出功能的，就不需要进入文件查看具体的实现，这只是看起来不起眼但实际上是相当提升效率的操作。

往下是类的属性定义部分，我这里的设计将模块，控制器以及方法完全分开，单独进行了处理，并且设计了一个变量用来存储应用文件的路径。

这里的设计，**要关注的点是 url.php 这个功能组件被设计用来干什么**，其内部的具体实现都是基于这个目的来的，1.0 demo 中，**url.php 被设计用来解析超全局数组得到具体的路由信息，这是我们的目的**。

>明确了这个目的之后，再往下就是对抽象目标的具体建模。
=
为了达到拿到路由信息的目的，属性定义可以有各种各样的实现方法，如将所有的变量都可以放到一个数组当中，而不是拆开来做。具体选择哪种做法，需要根据场景来进行设计。
=
比如我现在做的这个框架 demo，只需要跑通流程就可以，并需要考虑的太多，如果是商用的，情况肯定是不一样的，需要考虑实际的使用情况，如何设计会更便捷、更易于使用，从这样的一个角度出发，可能用数组来进行组织可能是更好的解决方法，使用时，不会像这种设计这样麻烦，后面说明方法设计时，会进一步解释。

继续往下就到了方法部分。

其中 get 和 set 我认为应该成为一种标配，类中所有属性值的设置和取用都应该通过对外统一的接口来操作，统一、规范和标准的目的是为了工程实践中的便捷，所有的类属性的取用设置都使用同样的方式，会减少学习成本，这是采用这种设计的主要理由。

接下来就到了本功能组件最重要的部分，**function analyse**。

**关注点依然要放在其目的上，而不是其实现细节**，因为实现的细节会因属性设计部分的变更而变更，目前呈现的这种形式是由属性设计而决定的，这一点一定要特别清楚，当在学习其他框架时无需太关注于其中的细节，只需要弄明白当前功能组件实现的功能是什么即可。

在这里，analyse 所做的就是根据请求拿到需要执行文件的路由。

最后还有一点要进行说明：

    pubic static function analyse($data = []){
        ...
    }

这里使用的是 static，只所以这样设计，是为了使用静态的一个特性，在执行静态方法时不需要创建一个对象，然后借助对象来调用方法，会让脚本变得简洁、易懂。

比如，index.php 中就可以这样写：

    ...
    // 解析数组拿到路径
    url::analyse($_SERVER);
    ...

看起来非常的简洁，less is more。