# 介绍
> 这是一个简单的php `api`开发框架，设计上模仿`ThinkPHP`。 
> 
> 没有`视图（view）`  没有`模型（model）`
> 
> 只有`控制器（controller）` 和`数据库（databse）`以及`帮助函数（helper）`组成，纯粹为API接口开发诞生。

**开发它的理由**

这两天有幸接触到了ecshop二次开发。 阅读了前辈们的api接口结构。  大致如下：
```
goods\sel_list.php
goods\get_detail.php
goods\sel_comments.php
mysql.php
```
把我震惊到了， 而且目录很多。 这还是最规范的一个写法。  同事们完全各自发挥。  数据库连接就好几处。

一上手还用不了事务， 封装的数据库类。 流程如下。
```
public function query($sql)
{
    // 连接mysql
    // 执行sql
    // 关闭mysql
    // 返回结果
}
```

我想我得自己写个连接。。。。  以支持事务...

--------

所以造了这个轮子， 希望能规范一下接口， 并且让资源得到复用。  把开发人员限制在一个标准内。


# 目录结构
```
├── api.php		// 入口
├── common.php	// 公共
├── config.php	// 配置
├── controller	// 控制器目录
│   └── Hello.php	// 示例控制器 (规范参考thinkphp)
├── helper.php	// 帮助函数
├── lib			// 库
│   └── Db.php	// 数据库
└── README.md

```

# 控制器

>  `Hello.php` 
>
> 这是一个示例控制器, 编写规范参考thinkphp

```php
class Hello extends Common {

    public function get()
    {
        $text = input('text');
        $this->returnMessage(200, $text);
    }
}
```
# URL

> {域名}/{入口文件}?go={控制器名}.{方法名}&参数a=11&参数b=22....

参考`示例控制器`, 访问地址为:

-  `http://localhost/api.php?go=hello.get&text=success`

# 数据库

> 敬请期待...  将会是类似TP的连贯操作方式