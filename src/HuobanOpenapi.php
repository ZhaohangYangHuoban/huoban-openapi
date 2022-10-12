<?php
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenapi;

use Exception;
use HuobanOpenapi\Contracts\Factory;
use HuobanOpenapi\Request\GuzzleRequest;

class HuobanOpenapi implements Factory
{
    use \HuobanOpenapi\StandardComponent\Config;
    use \HuobanOpenapi\StandardComponent\HuobanStandardConfig;

    public $request;
    protected $models = [];

    public function __construct($config)
    {
        $config = $config + $this->getStandardConfig();

        $this->initConfig($config);
        $this->request = new GuzzleRequest($this->config);
    }

    public function make($model_name, $standard = false)
    {
        // 非标准返回返回新建数据对象，【swoole等常驻内存，避免相互影响】
        if (!$standard) {
            return $this->resolve($model_name);
        }

        if (!isset($this->models[$model_name])) {
            $this->models[$model_name] = $this->resolve($model_name);
        }

        return $this->models[$model_name];

    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    protected function resolve($model_name)
    {
        $model = '\\HuobanOpenapi\\Models\\Huoban' . ucfirst($model_name);
        return new $model($this->request, $this->config);
    }
}
