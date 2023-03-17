<?php

namespace HuobanOpenApi\Models;

use HuobanOpenApi\Models\Basic\HuobanBasic;

class HuobanItemDw extends HuobanBasic
{
    use \HuobanOpenApi\Models\Components\Item\Format;

    /**
     * 增
     *
     * @param array $body
     * @param array $options
     * @return void
     */
    public function create(array $body = [], array $options = [])
    {
        return $this->execute('POST', "/dw_item", $body, $options);
    }

    /**
     * 删
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return void
     */
    public function del(int $item_id, array $body = [], array $options = [])
    {
        return $this->execute('DELETE', "/dw_item/{$item_id}", $body, $options);
    }

    /**
     * 改
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return void
     */
    public function update(int $item_id, array $body = [], array $options = [])
    {
        return $this->execute('PUT', "/dw_item/{$item_id}", $body, $options);
    }

    /**
     * 获取单条数据
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return void
     */
    public function get(int $item_id, array $body = [], array $options = [])
    {
        return $this->execute('POST', "/dw_item/{$item_id}", $body, $options);
    }

    /**
     * 查
     *
     * @param array $body
     * @param array $options
     * @return void
     */
    public function find(array $body = [], array $options = [])
    {
        return $this->execute('POST', "/dw_item/list", $body, $options);
    }
}
