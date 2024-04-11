<?php

namespace HuobanOpenApi\Models;

use HuobanOpenApi\Models\Basic\HuobanBasic;

class HuobanItemDw extends HuobanBasic
{
    /**
     * 增
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function create( array $body = [], array $options = [] )
    {
        return $this->request->execute( 'POST', "/dw_item", $body, $options );
    }

    /**
     * 增【批量】
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function creates( array $body = [], array $options = [] )
    {
        return $this->request->execute( 'POST', "/dw_item", $body, $options );
    }


    /**
     * 删
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return array
     */
    public function del( int $item_id, array $body = [], array $options = [] )
    {
        $body['item_ids'][] = $item_id;

        return $this->dels( $body, $options );
    }

    /**
     * 删[批量]
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function dels( array $body = [], array $options = [] ) : array
    {
        return $this->request->execute( 'DELETE', "/dw_item", $body, $options );
    }

    /**
     * 改
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return array
     */
    public function update( int $item_id, array $body = [], array $options = [] )
    {
        return $this->request->execute( 'PUT', "/dw_item/{$item_id}", $body, $options );
    }

    /**
     * 改[批量]
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function updates( array $body = [], array $options = [] ) : array
    {
        return $this->request->execute( 'PUT', "/dw_item", $body, $options );
    }

    /**
     * 获取单条数据
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return array
     */
    public function get( int $item_id, array $body = [], array $options = [] )
    {
        return $this->request->execute( 'POST', "/dw_item/{$item_id}", $body, $options );
    }

    /**
     * 查
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function find( array $body = [], array $options = [] )
    {
        return $this->request->execute( 'POST', "/dw_item/list", $body, $options );
    }
}