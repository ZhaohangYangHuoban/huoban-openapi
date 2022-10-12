<?php
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenapi\Models;

use HuobanOpenapi\Contracts\HuoBanRequestInterface;

class HuobanBasic
{
    use \HuobanOpenapi\StandardComponent\Config;

    public $request;

    public $method;
    public $path;

    public function __construct(HuoBanRequestInterface $request, $config)
    {
        $this->initConfig($config);
        $this->request = $request;
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

        $response = $this->request->execute($method, $url, $body, $options);
        return $response['data'] ?? $response;
    }

}
