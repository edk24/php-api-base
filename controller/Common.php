<?php
/**
 * 公共控制器
 * @author 余小波 <1421926943@qq.com>
 */

class Common {
    /**
     * 响应数据
     *
     * @param integer $code 状态码
     * @param string $msg 消息文本
     * @param array $data 数据本体
     * @param integer $count 页数、记录数
     * @return void
     */
    public function returnMessage($code=200, $msg='', $data=[], $count=0)
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