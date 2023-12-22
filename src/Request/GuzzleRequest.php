<?php

namespace HuobanOpenApi\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use HuobanOpenApi\Contracts\HuobanConfigInterface;
use HuobanOpenApi\Contracts\HuobanRequestInterface;
use HuobanOpenApi\Config\HuobanConfig;

class GuzzleRequest implements HuobanRequestInterface
{
    protected HuobanConfigInterface $huobanConfig;

    /**
     * 请求客户端对象
     */
    protected Client $client;

    /**
     * 初始化配置信息
     *
     * @param array $config
     */
    public function __construct( array $config )
    {
        $this->huobanConfig = new HuobanConfig( $config );
    }

    /**
     * 设置请求的默认请求头
     *
     * @param array $options
     * @return array
     */
    public function defaultHeader( array $options = [] ) : array
    {
        $default_headers = [ 
            'Content-Type'       => 'application/json',
            'Open-Authorization' => 'Bearer ' . $this->huobanConfig->getApiKey(),
        ];

        $options_headers = $options['headers'] ?? [];
        return array_merge( $default_headers, $options_headers );
    }

    /**
     * 获取请求客户端
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient() : Client
    {
        if ( ! isset( $this->client ) || ! $this->client ) {
            $this->client = new Client( [ 
                'base_uri'    => $this->huobanConfig->getApiUrl(),
                'timeout'     => 600,
                'verify'      => false,
                'http_errors' => true,
                'headers'     => $this->defaultHeader(),
            ] );
        }
        return $this->client;
    }

    /**
     * 获取执行工作的请求
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return Request
     */
    public function getRequest( string $method, string $url, array $body = [], array $options = [] ) : Request
    {
        $url     = '/openapi/' . ( $options['version'] ?? 'v1' ) . $url;
        $body    = json_encode( $body );
        $headers = $this->defaultHeader( $options );

        return new Request( $method, $url, $headers, $body );
    }

    /**
     * 发送请求，并返回结果
     *
     * @param RequestInterface $request
     * @return array
     */
    public function requestJsonSync( RequestInterface $request ) : array
    {
        try {
            $response = $this->getHttpClient()->send( $request );
        } catch ( ServerException $e ) {
            $response = $e->getResponse();
        }

        return json_decode( $response->getBody(), true );
    }

    /**
     * 根据传入的多个请求对象，执行并发请求并返回结果
     *
     * @param array $requests
     * @param integer|null $concurrency
     * @return array
     */
    public function requestJsonPool( array $requests, ?int $concurrency = 20 ) : array
    {

        $success_data = $error_data = [];
        $client = $this->getHttpClient();

        $pool = new Pool( $client, $requests, [ 
            'concurrency' => $concurrency,
            'fulfilled'   => function ($response, $index) use (&$success_data)
            {
                $success_data[] = [ 
                    'index'    => $index,
                    'response' => json_decode( $response->getBody(), true ),
                ];
            },
            'rejected'    => function ($response, $index) use (&$error_data)
            {
                $error_data[] = [ 
                    'index'    => $index,
                    'response' => $response,
                ];
            },
        ] );

        $promise = $pool->promise();
        $promise->wait();
        return [ 'success_data' => $success_data, 'error_data' => $error_data ];
    }

    /**
     * 执行一般请求
     *
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $options
     * @return array
     */
    public function execute( string $method, string $url, array $body = [], array $options = [] ) : array
    {
        $request = $this->getRequest( $method, $url, $body, $options );
        return $this->requestJsonSync( $request );
    }

    /**
     * 执行上传请求
     *
     * @param string $method
     * @param string $url
     * @param array  $body
     * @param array  $options
     * @return array
     */
    public function fileUpload( string $method, string $url, array $body = [], array $options = [] ) : array
    {
        $url      = '/openapi/' . ( $options['version'] ?? 'v1' ) . $url;
        $response = $this->getHttpClient()->request( $method, $url, $body );

        return json_decode( $response->getBody(), true );
    }
}