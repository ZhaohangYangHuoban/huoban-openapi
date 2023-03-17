<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenApi;

use HuobanOpenApi\Request\GuzzleRequest;

class HuobanOpenApi
{
    use \HuobanOpenApi\StandardComponent\Config;
    public $config;
    public $request;

    /**
     * 构造函数
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $config  = $config + $this->getStandardConfig();

        $this->initConfig($config);
        $this->request = new GuzzleRequest($config);
    }

    /**
     * 标准配置
     *
     * @return array
     */
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
