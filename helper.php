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
if (!function_exists('input')) {
    function input($name='', $default='') {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        } else if (isset($_POST[$name])) {
            return $_POST[$name];
        } else {
            return $default;
        }
    }
}

/**
 * Json响应结果
 */
if (!function_exists('retMsg')) {
    /**
     * Json响应结果，会结束脚本
     *
     * @param integer $code 状态码，建议同一使用200表示成功
     * @param string $msg 消息字符串
     * @param array $data  数据
     * @param integer $count 数量 （可作为总数、页数使用）
     * @return void
     */
    function retMsg($code=200, $msg='', $data=[], $count=0)
    {
        header('Content-type: application/json');
        $dump['code']=$code;
        $dump['msg']=$msg;
        $dump['data']=$data;
        $dump['count']=$count;
        echo json_encode($dump);
        exit;
    }
}
