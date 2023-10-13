<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenApi;

use HuobanOpenapi\Contracts\HuoBanRequestInterface;

use HuobanOpenapi\Models\HuobanTable;
use HuobanOpenapi\Models\HuobanFile;
use HuobanOpenApi\Models\HuobanItem;

class HuobanOpenApi
{
    public $huobanRequest;
    public $huobanOpenapiItem;
    public $huobanOpenapiTable;
    public $huobanOpenapiFile;

    public array $items = [];
    public array $tables = [];

    public function __construct( HuobanRequestInterface $huobanRequest )
    {
        $this->huobanRequest = $huobanRequest;
    }

    public function getHuobanOpenapiItem() : HuobanItem
    {
        if ( ! $this->huobanOpenapiItem ) {
            $this->huobanOpenapiItem = new HuobanItem( $this->huobanRequest );
        }

        return $this->huobanOpenapiItem;
    }

    public function getHuobanOpenapiTable() : HuobanTable
    {
        if ( ! $this->huobanOpenapiTable ) {
            $this->huobanOpenapiTable = new HuobanTable( $this->huobanRequest );
        }

        return $this->huobanOpenapiTable;
    }

    public function getHuobanOpenapiFile() : HuobanFile
    {
        if ( ! $this->huobanOpenapiFile ) {
            $this->huobanOpenapiFile = new HuobanFile( $this->huobanRequest );
        }

        return $this->huobanOpenapiFile;
    }

    public function getItem( int $item_id, ?bool $cache = true )
    {

        if ( ! isset( $this->items[ $item_id ] ) || ! $cache ) {
            $this->items[ $item_id ] = $this->getHuobanOpenapiItem()->get( $item_id );
        }
        return $this->items[ $item_id ];
    }
    public function updateItem( int $item_id, array $body )
    {
        $this->items[ $item_id ] = $this->getHuobanOpenapiItem()->update( $item_id, $body );
        return $this->items[ $item_id ];
    }

    public function getTable( int $table_id, ?bool $cache = true )
    {
        if ( ! isset( $this->tables[ $table_id ] ) || ! $cache ) {
            $this->tables[ $table_id ] = $this->getHuobanOpenapiTable()->get( $table_id );
        }
        return $this->tables[ $table_id ];
    }

    public function uploadFile( string $file_path, string $file_name, ?string $file_type = 'attachment', ?array $options = [] )
    {
        //  example
        $body = [ 
            'multipart' => [ 
                [ 
                    'contents' => fopen( $file_path . '/' . $file_name, 'r' ),
                    'name'     => 'source',
                ],
                [ 
                    'name'     => 'type',
                    'contents' => $file_type,
                ],
                [ 
                    'name'     => 'name',
                    'contents' => $file_name,
                ],
            ],
        ];
        return $this->getHuobanOpenapiFile()->upload( $body, $options );
    }

    public function getFieldByFieldId( array $table, int|string $field_id ) : ?array
    {
        foreach ( $table['table']['fields'] as $field ) {
            if ( $field['field_id'] == $field_id ) {
                return $field;
            }
        }
        return null;
    }

    /**
     * 根据可选值范围[选项字段中某个选项，NAME出现的可能值集合]，返回指定表格字段的选项ID
     *
     * @param string|integer $table_id
     * @param string|integer $field_id
     * @param array $range
     * @return mixed
     */
    public function getCategoryIdByRange( string|int $table_id, string|int $field_id, array $range ) : mixed
    {
        $table = $this->getTable( (int) $table_id );
        $field = $this->getFieldByFieldId( $table, $field_id );

        $options = $field['config']['options'];

        foreach ( $options as $option ) {
            $category_id = $this->optionIsRange( $option, $range );
            if ( $category_id ) {
                return (int) $category_id;
            }
        }

        return null;
    }
    /**
     * 选项字段的某个选项,是否满足可选值范围的界定，满足返回当前选项的选项ID
     *
     * @param array $option
     * @param array $range
     * @return string|integer|boolean
     */
    public function optionIsRange( array $option, array $range ) : string|int|bool
    {
        foreach ( $range as $range_value ) {
            if ( str_contains( $option['name'], $range_value ) ) {
                return $option['id'];
            }
        }

        return false;
    }

    public function getDateByMillisecond( $millisecond )
    {
        return $millisecond ? date( 'Y-m-d', $millisecond / 1000 ) : '';
    }
    public function getDateTimeByMillisecond( $millisecond )
    {
        return $millisecond ? date( 'Y-m-d H:i:s', $millisecond / 1000 ) : '';
    }

}