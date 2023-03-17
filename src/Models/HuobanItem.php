<?php

namespace HuobanOpenApi\Models;

use HuobanOpenApi\Models\Basic\HuobanBasic;

class HuobanItem extends HuobanBasic
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
        return $this->execute('POST', "/item", $body, $options);
    }

    /**
     * 增[批量]
     *
     * @param array $body
     * @param array $options
     * @return void
     */
    public function creates(array $body = [], array $options = [])
    {
        return $this->execute('POST', "/items", $body, $options);
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
        return $this->execute('DELETE', "/item/{$item_id}", $body, $options);
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
        return $this->execute('PUT', "/item/{$item_id}", $body, $options);
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
        $data = $this->execute('POST', "/item/{$item_id}", $body, $options);
        return $options['only_item'] ?? $data['item'];
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
        return $this->execute('POST', "/item/list", $body, $options);
    }
}
