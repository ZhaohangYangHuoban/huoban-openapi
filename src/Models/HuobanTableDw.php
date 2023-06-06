<?php

namespace HuobanOpenApi\Models;

use HuobanOpenApi\Models\Basic\HuobanBasic;

class HuobanTableDw extends HuobanBasic
{
    /**
     * 获取表格配置
     *
     * @param [type] $table
     * @param [type] $body
     * @param array $options
     * @return array
     */
    public function get($tableId, $options = []): array
    {
        $body = [];
        return $this->request->execute('POST', "/dw_table/{$tableId}", $body, $options);
    }

    /**
     * 获取表格列表
     *
     * @param array $options
     * @return array
     */
    public function getTableList($options = []): array
    {
        $body = [];
        return $this->request->execute('POST', "/dw_table/list", $body, $options);
    }
}
