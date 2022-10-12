<?php
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-01-20 16:17:35
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenapi\StandardComponent;

trait HuobanStandardConfig
{
    public function getStandardConfig()
    {
        return [
            // 应用授权名称
            'name'    => 'huoban',
            // api 授权
            'api_key' => '',
            'api_url' => 'https://api.huoban.com/openapi',
        ];
    }

}
