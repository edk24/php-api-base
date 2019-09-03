<?php
class Error {
    public function __construct() {
        echo ROOT_PATH;
    }
    public function _init($actionName) {
        echo $actionName;
    }
    public function _empty($name) {
        echo $name;
    }
}