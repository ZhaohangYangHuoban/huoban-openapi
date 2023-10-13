<?php

namespace HuobanOpenApi\Contracts;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

interface HuobanRequestInterface
{
    /**
     * 执行一般请求
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return array
     */
    public function execute( string $method, string $url, array $body = [], array $options = [] ) : array;

    /**
     * 执行上传请求
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return array
     */
    public function fileUpload( string $method, string $url, array $body = [], array $options = [] ) : array;


}