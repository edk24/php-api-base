<?php
/**
 * 入口文件
 * @author 余小波 <1421926943@qq.com>
 * @version 1.0.0
 */

// 加载配置文件
require_once 'config.php';
require_once 'helper.php';
/**
 * api 入口 (不是通用的, 只是我写的接口打算这么用)
 * @author 余小波
 */
try {
    $data = explode('.', $_GET['go']);
    $controllerName = $data[0]; // 控制器
    $func = $data[1]; // 方法

    $path = 'controller/'.ucfirst($controllerName).'.php';
    if (!file_exists($path)) {
        throw new Exception('找不到控制器'.$controllerName, 400);
    }

    // 数据库
    include_once 'lib/Db.php';
    include_once 'controller/Common.php';
    include_once $path;

    // 模型 (没有)

    // 控制器
    if (!class_exists($controllerName)) {
        throw new Exception("找不到 $controllerName 控制器", 400);
    }
    

    $controller = new $controllerName();
    $f = new ReflectionMethod($controller, $func);
    $args = [];
    foreach ($f->getParameters() as $param) {
        if ($param->isOptional()) {
            $args[] = input($param->getName(), $param->getDefaultValue());
        } else {
            $args[] = input($param->getName());
        }
        
    }
    

    if (!method_exists($controller, $func)) {
        throw new Exception("未定义 $func 方法", 400);
    }
    $result = call_user_func_array(array($controller, $func), $args);

    // 视图 (直接输出)
    echo $result;
    exit;
} catch(\Exception $e) {
    echo json_encode(['code'=>400, 'msg'=>$e->getMessage()]);
}
