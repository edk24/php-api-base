<?php
/**
 * 入口文件
 * @author 余小波 <1421926943@qq.com>
 * @version 1.0.0
 */

// 加载配置文件
require_once 'config.php';
require_once 'helper.php';
require_once 'common.php';

require_once 'lib/Core.php';
require_once 'lib/Db.php';


try {
    /**
     * 参数绑定
     *
     * @param [type] $controller
     * @param [type] $func
     * @param array $args
     * @return void
     */
    function BindParameter($controller, $func, &$args=[])
    {
        $f = new ReflectionMethod($controller, $func);
        foreach ($f->getParameters() as $param) {
            if ($param->isOptional()) {
                $args[] = input($param->getName(), $param->getDefaultValue());
            } else {
                $args[] = input($param->getName());
            }
        }
        return $args;
    }

    $data = explode('.', $_GET['go']);
    $controllerName = $data[0]; // 控制器
    $actionName = $data[1]; // 方法

    $core = new Core();
    $success = $core->load($controllerName);
    if (!$success) {
        // 试图加载空控制器
        $success = $core->load('Error');
        if (!$success) {
            throw new Exception("未找到 $controllerName 控制器", 100); 
        }
    }

    
    // 初始化
    $core->exec('_init', [$actionName], $result);

    // 执行操作
    $result = null;
    $success = $core->exec($actionName, [], $result);
    if (!$success) {
        // 试图执行空操作
        $result = $core->call('_empty', [$actionName]);
    }

    echo $result;
    exit;
} catch(\Exception $e) {
    echo json_encode(['code'=>400, 'msg'=>$e->getMessage()]);
}
