<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2023-03-17 14:50:45
 * @Description: 伙伴KA研发部
 */

namespace HuobanOpenApi\Helpers;

class HuobanVerify
{
    /**
     * 效验伙伴请求返回结果
     *
     * @param [type] $response
     * @param string $location
     * @return void
     */
    public static function verifyHuobanResponse( $response, $supplementary = '' )
    {
        if ( isset( $response['code'] ) ) {
            $message = $response['message'] ?? '未知错误信息';
            $message .= ' 【' . $supplementary . '】';

            $location = debug_backtrace();
            throw new \Exception( $location . $message, $response['code'] );
        }
    }
}
