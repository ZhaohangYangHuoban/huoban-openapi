<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenApi;

use HuobanOpenApi\Request\GuzzleRequest;
use HuobanOpenApi\Contracts\HuobanRequestInterface;
use HuobanOpenApi\Models\HuobanFile;
use HuobanOpenApi\Models\HuobanItem;
use HuobanOpenApi\Models\HuobanItemDw;
use HuobanOpenApi\Models\HuobanTable;
use HuobanOpenApi\Models\HuobanTableDw;

use function PHPSTORM_META\expectedReturnValues;

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

    public function getHuobanItem(): HuobanItem
    {
        return  new HuobanItem($this->request);
    }
}
