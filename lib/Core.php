<?php
class Core {
    public $controller;

    // 加载控制器
    public function load($controllerName) {
        $this->unload();

        $path = 'controller/'.ucfirst($controllerName).'.php';

        if (!file_exists($path)) {
            return false;
        }

        include_once $path;

        if (!class_exists($controllerName)) {
            return false;
        }
        // 实例化
        $this->controller = new $controllerName();
        return true;
    }

    // 销毁
    public function unload() {
        $this->controller = null;
    }

    // 执行操作
    public function exec($actionName, $args, &$result) {
        if (!method_exists($this->controller, $actionName)) {
            return false;
        }

        BindParameter($this->controller, $actionName, $args);
        if (!method_exists($this->controller, '_init')) {
            call_user_func_array(array($this->controller, '_init'), [$args]);
        }
        $result = call_user_func_array(array($this->controller, $actionName), $args);
        return true;
    }

    // 执行类方法 (返回执行结果)
    public function call($actionName, $args) {
        if (!method_exists($this->controller, $actionName)) {
            throw new Exception("未找到 $actionName 操作", 101);
        }

        $result = call_user_func_array(array($this->controller, $actionName), $args);
        return $result;
    }
}