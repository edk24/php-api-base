<?php
/**
 * 入口文件
 * @author 余小波 <1421926943@qq.com>
 * @version 1.0.0
 */

// 加载配置文件
require_once 'config.php';

// 使用数据库
// require_once 'lib/Database.class.php';


try {
    $tmp = explode('.', $_GET['go']);
    $controller = ucfirst($tmp[0]);
    $func = $tmp[1];

    $path = 'controller/'.$controller.'.php';
    if (!file_exists($path)) {
        throw new Exception('未定义 '.$controller.' 控制器', 1);
    }

    require_once 'controller/Common.php';
    require_once $path;
    if (!class_exists($controller)) {
        throw new Exception('未定义 '.$controller.' 控制器', 1);
    }
    $class = new $controller();
    if (!method_exists($class, $func)) {
        throw new Exception('未定义 '.$func.' 方法', 1);
    }

    $result = $class->$func();
    echo $result;
    exit;
} catch (Exception $e) {
    echo json_encode(['code'=>$e->getCode(), 'msg'=>$e->getMessage(), 'data'=>[], 'count'=>'']);
}