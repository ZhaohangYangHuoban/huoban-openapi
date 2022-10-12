<?php
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenapi\Helpers;

class HuobanVerify
{
    /**
     * 效验伙伴请求返回结果
     *
     * @param [type] $response
     * @param string $location
     * @return void
     */
    public static function verifyHuobanResponse($response, $supplementary = '')
    {
        if (isset($response['code'])) {
            $message = $response['message'] ?? '未知错误信息';
            $message .= ' 【' . $supplementary . '】';

            $location = debug_backtrace();
            throw new \Exception($location . $message, $response['code']);
        }
    }

}
