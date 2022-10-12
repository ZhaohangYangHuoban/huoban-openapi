<?php

namespace HuobanOpenapi\StandardComponent;

trait Config
{
    /**
     * 配置文件
     */
    protected $config;

    /**
     * 初始化配置
     *
     * @param array|null $config
     * @return void
     */
    public function initConfig(?array $config = [])
    {
        $this->config = $config;
    }

    /**
     * 修改配置项
     *
     * @param string $key
     * @param string|array $val
     * @return void
     */
    public function setConfig(string $key, string|array $val)
    {
        $this->config[$key] = $val;
    }

    /**
     * 获取配置项
     *
     * @param string $key
     * @return void
     */
    public function getConfig(string $key): string|array
    {
        return $this->config[$key] ?? null;
    }
}
