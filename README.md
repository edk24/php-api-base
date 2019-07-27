# 介绍
这是一个简单的php `api`开发框架，设计上模仿`ThinkPHP`。 

没有`视图（view）`  没有`模型（model）`

只有`控制器（controller）` 和`数据库（databse）`以及`帮助函数（helper）`组成，纯粹为API接口开发诞生。

**开发它的理由**

这两天有幸接触到了ecshop二次开发。 阅读了前辈们的api接口结构。  大致如下：
```
goods\sel_list.php
goods\get_detail.php
goods\sel_comments.php
mysql.php
```
把我精到了， 而且目录很多。 这还是最规范的一个写法。  完全各自发挥。  数据库连接就好几处。

一上手还用不了事务， 封装的数据库类。 执行时连接， 执行完就close了。
```
public function query($sql)
{
    // 连接mysql
    // 执行sql
    // 关闭mysql
    // 返回结果
}
```

我想我得自己写个连接。。。。

--------

所以造了这个轮子， 希望能规范一下接口， 并且让资源得到复用。  把开发人员限制在一个标准内。


# 目录结构
```
controller/Common.php  // 基础控制器、公共
controller/Hello.php  // 示例控制器 （参考`ThinkPHP`规范）
lib/Database.class.php // 数据库类库
config.php // 配置文件
helper.php  // 帮助函数
Api.php   // 入口文件
```

# URL请求
这是一个示例控制器
```php
class Hello extends Common {

    public function get()
    {
        $text = input('text');
        $this->returnMessage(200, $text);
    }
}
```
域名/入口文件?go=控制器名.方法名&参数a=11&参数b=22....

请求地址： `http://localhost/api.php?go=hello.get&text=success`