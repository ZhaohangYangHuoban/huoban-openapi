<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenApi\Models\Basic;

use HuobanOpenApi\HuobanOpenApi;

class HuobanBasic
{
    public $huobanOpenApi;

    public function __construct(HuobanOpenApi $huobanOpenApi)
    {
        $this->huobanOpenApi = $huobanOpenApi;
    }

    /**
     * 执行
     *
     * @param array $body
     * @param array $options
     * @return mixed
     */
    public function execute(string $method, string $url, array $body = [], array $options = []): mixed
    {
        $response = $this->huobanOpenApi->request->execute($method, $url, $body, $options);
        return $response['data'] ?? $response;
    }
}
