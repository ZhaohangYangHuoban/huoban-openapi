<?php

namespace HuobanOpenApi\Contracts;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

interface HuoBanRequestInterface
{
    /**
     * 执行请求
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return array
     */
    public function execute(string $method, string $url, array $body = [], array $options = []): array;

    /**
     * 执行上传
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return array
     */
    public function fileUpload(string $method, string $url, array $body = [], array $options = []): array;

    /**
     * 生成请求对象
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return RequestInterface
     */
    public function getRequest(string $method, string $url, array $body = [], array $options = []): RequestInterface;

    /**
     * 生成请求客户端
     *
     * @return object
     */
    public function getHttpClient(): ClientInterface;

    /**
     * 根据传入的请求对象执行请求并返回结果
     *
     * @param RequestInterface $request
     * @return void
     */
    public function requestJsonSync(RequestInterface $request);

    /**
     * 根据传入的多个请求对象，执行并发请求并返回结果
     *
     * @param array $requests
     * @return void
     */
    public function requestJsonPool(array $requests);
}
