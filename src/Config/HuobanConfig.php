<?php

namespace HuobanOpenApi\Config;

use HuobanOpenApi\Contracts\HuobanConfigInterface;

class HuobanConfig implements HuobanConfigInterface
{

    public array $config;

    public function __construct( array $config )
    {
        // $config = [ 
        //     // 应用名称，为了区分不同授权交叉使用区分
        //     'name'   => '',
        //     // 应用授权，v5伙伴后台申请
        //     'apiKey' => '',
        //     // 应用环境，是否为测试环境
        //     'isDev'  => '',
        // ];

        $this->config = $config;
    }
    public function getName() : string
    {
        return $this->getValue( 'name' );
    }
    public function getApiKey() : string
    {
        return $this->getValue( 'apiKey' );
    }
    public function getApiUrl() : string
    {
        return $this->getValue( 'isDev' ) == true ? 'https://api.huoban.com/openapi' : 'https://api.huoban.com/openapi';
    }
    public function getValue( $key ) : string
    {
        return $this->config[ $key ] ?? null;
    }
}