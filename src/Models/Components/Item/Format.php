<?php

namespace HuobanOpenapi\Models\Components\Item;

/**
 * 数据格式化
 */
trait Format
{
    /**
     * 查符合条件的数据数量
     *
     * @param array $body
     * @param array $options
     * @return void
     */
    public function getFiltered(array $body = [], array $options = [])
    {
        $body['limit'] = 1;
        $response      = $this->find($body, $options);

        return $response['filtered'];
    }

    /**
     * 查数据总数量
     *
     * @param array $body
     * @param array $options
     * @return void
     */
    public function getTotal(array $body = [], array $options = [])
    {
        $body['limit'] = 1;
        $response      = $this->find($body, $options);

        return $response['total'];
    }

    /**
     * 格式化查询数据条件信息【批量】
     *
     * @param array $items
     * @return void
     */
    public function handleItems(array $items = [])
    {
        $format_items = [];
        foreach ($items as $item) {
            $item_id                = (string) $item['item_id'];
            $format_items[$item_id] = $this->returnDiy($item);
        }
        return $format_items;
    }

    /**
     * 格式化查询数据条件信息【单条】
     *
     * @param array $items
     * @return void
     */
    public function returnDiy($item, $type = 'api')
    {
        return $item['item'] ?? $item;
    }
}
