<?php
class Controller {
    public $_controllerName;
    public $_atcionName;

    public function getControllerName() {
        return $this->_controllerName;
    }

    public function getActionName() {
        return $this->_atcionName;   
    }
}