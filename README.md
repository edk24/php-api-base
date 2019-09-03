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
├── api.php				// 入口
├── common.php			// 公共
├── config.php			// 配置
├── controller			// 控制器目录
│   ├── Error.php		// 空控制器示例
│   └── Hello.php		// 控制器示例
├── helper.php			// 帮助函数
├── lib					// 库
│   ├── Controller.php	// 控制器祖宗
│   ├── Core.php		// 核心
│   └── Db.php			// 数据库操作类
└── README.md			

```

# 控制器

> 控制器部分可参考thinkphp编写规范

## 1.示例控制器

>  `Hello.php` 

```php
class Hello {

    public function get()
    {
        $name = input('name');
        retMsg(200, '你好 '.$name.'，欢迎使用api-base框架');
    }
}
```
访问地址: http://localhost/api.php?go=hello.get&name=余晓波

## 2.参数绑定

> Q: 为什么要有参数绑定
>
> A: 简洁方法时, 同时可以在内部让方法得到复用.  跟普通对象一样使用

```php
public function get($name='')
{
    retMsg(200, '你好 '.$name.'，欢迎使用api-base框架');
}
```

## 3.空控制器

> 空控制器名称为`Error`

`Error.php`

```php
class Error {
	public function _empty($actionName) {
		// 目前这个版本不能获取控制器名称
	}
}
```

## 4.空操作

> 空操作方法名称为`_empty`, 不能使用`参数绑定`.  只有一个参数即`操作名`

```php
public function _empty($actionName) {
	echo $actionName;
}
```

## 5.控制器继承

> 控制器是可继承的, 参考tp

```php
class Hello extends Common
{

}
```



## 6.控制器初始化

> 在你的控制器中声明一个`_init()`的操作, 它会在执行操作前运行

```php
class Hello {
    public function _init()
    {
        echo "初始化";
    }

    public function test()
    {
        echo "test操作";
    }
}
```

运行结果为:

```html
初始化
test操作
```

# URL

> {域名}/{入口文件}?go={控制器名}.{方法名}&参数a=11&参数b=22....

参考`示例控制器`, 访问地址为:

-  `http://localhost/api.php?go=hello.get&text=success`

# 数据库

> 敬请期待...  类似TP的连贯操作方式

# 常量参考

| 名称      | 描述       | 示例结果               |
| --------- | ---------- | ---------------------- |
| ROOT_PATH | 项目根目录 | /www/wwwroot/edk24.com |
| VERSION   | 框架版本   | 1.00                   |

