<?php
/**
 * 帮助函数
 * @author 余小波 <1421926943@qq.com>
 */


 /**
  * 获取参数
  *
  * @param string $name 参数名称 可以是 phone（优先取GET）、 get.phone、post.phone
  * @param string $default 默认返回值
  * @return void
  */
function input($name='', $default='') {
    $tmp = explain('.', $name);
    if (count($tmp)==2) {
        $type   = $tmp[0];
        $key    = $tmp[1];
        if ($type=='get') {
            return (isset($_GET[$key])?$_GET[$key]:$default);
        } else if ($type=='post') {
            return (isset($_POST[$key])?$_POST[$key]:$default);
        } 
    } 

    if (isset($_GET[$name])) {
        return $_GET[$name];
    } else if (isset($_POST[$name])) {
        return $_POST[$name];
    } else {
        return $default;
    }
}

/**
 * 使用数据库， 与tp5用法类似
 *
 * @param string $tableName
 * @return void
 */
function db($tableName='') {
    
}