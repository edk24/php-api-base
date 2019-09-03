<?php
/**
 * 一个示例
 * @author 余小波 <1421926943@qq.com>
 */
class Hello {

    // 操作示例 + 参数绑定示例
    public function get($ww=0)
    {
        $data['author'] = '剑齿虎（余小波） QQ：1421926943';
        $data['home'] = 'http://edk24.com';
        retMsg(200, '你好，欢迎使用api-base框架'.$ww, $data);
    }

    // 空操作示例
    public function _empty($name='') {

    }
}