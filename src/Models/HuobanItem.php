<?php

namespace HuobanOpenApi\Models;

use HuobanOpenApi\Models\Basic\HuobanBasic;

class HuobanItem extends HuobanBasic
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
        return $this->request->execute( 'POST', "/item", $body, $options );
    }

    /**
     * 增[批量]
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function creates( array $body = [], array $options = [] )
    {
        return $this->request->execute( 'POST', "/items", $body, $options );
    }

    /**
     * 删
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return array
     */
    public function del( int $item_id, array $body = [], array $options = [] ) : array
    {
        return $this->request->execute( 'DELETE', "/item/{$item_id}", $body, $options );
    }

    /**
     * 改
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return array
     */
    public function update( int $item_id, array $body = [], array $options = [] ) : array
    {
        return $this->request->execute( 'PUT', "/item/{$item_id}", $body, $options );
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
        return $this->request->execute( 'PUT', "/items", $body, $options );
    }

    /**
     * 获取单条数据
     *
     * @param integer $item_id
     * @param array $body
     * @param array $options
     * @return array
     */
    public function get( int $item_id, array $body = [], array $options = [] ) : array
    {
        return $this->request->execute( 'POST', "/item/{$item_id}", $body, $options );
    }

    /**
     * 查
     *
     * @param array $body
     * @param array $options
     * @return array
     */
    public function find( array $body = [], array $options = [] ) : array
    {
        return $this->request->execute( 'POST', "/item/list", $body, $options );
    }
}