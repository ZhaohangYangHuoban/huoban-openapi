<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2023-03-17 14:50:45
 * @Description: 伙伴KA研发部
 */

namespace HuobanOpenApi\Helpers;

/**
 * 筛选器
 */
class HuobanFilter
{
    /**
     * 请求结构体
     *
     * @var array
     */
    public $body = [];

    /**
     * 请求表格ID
     */
    public $tableId;

    public function __construct($tableId)
    {
        $this->tableId = $tableId;
        $this->setBodyFefault();
    }

    /**
     * 清空请求体，为了重新获取请求体
     *
     * @param integer|null $tableId
     * @return void
     */
    public function clearBody(?int $tableId): void
    {
        $this->body = [];
        $this->setBodyFefault();
    }

    /**
     * 设置查询结果条数默认值
     *
     * @return void
     */
    public function setBodyFefault(): void
    {
        $this->body['table_id'] = $this->tableId;

        $this->body['limit']  = 500;
        $this->body['offset'] = 0;
    }

    /**
     * 获取筛选器结构
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * 根据条件生成结构匹配条件
     *
     * @param array $conditions
     * @return object
     */
    public function setFilter(array $conditions): object
    {
        // 如果之前没有条件结构，则新创建一个
        !isset($this->body['filter']['and']) && $this->body['filter'] = ['and' => []];

        foreach ($conditions as $condition) {
            foreach ($condition as $field => $query) {

                $this->body['filter']['and'][] = [
                    'field' => $field,
                    'query' => $query,
                ];
            }
        }
        return $this;
    }

    /**
     * 对结果排序
     *
     * @param array $conditions
     * @return object
     */
    public function setOrderBy(array $conditions): object
    {
        !isset($this->body['order_by']) && $this->body['order_by'] = [];

        foreach ($conditions as $condition) {
            foreach ($condition as $field => $sort) {

                $this->body['order_by'][] = [
                    'field' => $field,
                    'sort'  => $sort,
                ];
            }
        }
        return $this;
    }

    /**
     * 根据条件生成结构搜索条件
     *
     * @param array $field_ids
     * @param array $keywords
     * @return object
     */
    public function setSearch(array $field_ids, array $keywords): object
    {
        $this->body['search'] = [
            'fields'   => $field_ids,
            'keywords' => $keywords,
        ];

        return $this;
    }

    /**
     * 判断请求体是否已经存在指定的field
     *
     * @param [type] $field
     * @return bool
     */
    public function getFilterConditionsRepeatKey(string $field, ?array $filter): bool
    {
        $and = $filter ? $filter['and'] : $this->body['filter']['and'];

        foreach ($and as $key => $value) {

            if (isset($value['or']) && is_array($value['or'])) {
                if ($this->getFilterConditionsRepeatKey($field, $value['or'])) {
                    return true;
                }
            }

            if ($field == $value['field']) {
                return true;
            }
        }
        return false;
    }

    /**
     * 设置单次查询条数
     *
     * @param integer $limit
     * @return object
     */
    public function setLimit(int $limit): object
    {
        $this->body['limit'] = $limit;
        return $this;
    }

    /**
     * 设置单次查询起始位置
     *
     * @param integer $offset
     * @return object
     */
    public function setOffset(int $offset): object
    {
        $this->body['offset'] = $offset;
        return $this;
    }

    /**
     * 设置筛选器条件，Item_ids
     *
     * @return object
     */
    public function inItemIds($item_ids): object
    {
        $condition = ['item_id' => ['in' => $item_ids]];
        $this->setFilter([$condition]);

        return $this;
    }

    public function eq($field, $value): object
    {
        $condition = [$field => ['eq' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //等于

    public function ne($field, $value): object
    {
        $condition = [$field => ['ne' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //不等于

    public function gt($field, $value): object
    {
        $condition = [$field => ['gt' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //大于

    public function gte($field, $value): object
    {
        $condition = [$field => ['gte' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //大等于

    public function lt($field, $value): object
    {
        $condition = [$field => ['lt' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //小于

    public function lte($field, $value): object
    {
        $condition = [$field => ['lte' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //小等于

    public function in($field, array $value): object
    {
        $condition = [$field => ['in' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //包含

    public function nin($field, array $value): object
    {
        $condition = [$field => ['nin' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //不包含

    public function em($field, bool $value): object
    {
        $condition = [$field => ['em' => $value]];
        $this->setFilter([$condition]);

        return $this;
    } //是否为空

    /**
     * 同时设置多个条件
     *
     * @param [type] $field
     * @param [type] $condition
     * @return object
     */
    public function addFilterOr($field, $condition): object
    {
        $condition = [$field => [$condition]];
        $this->setFilter([$condition]);

        return $this;
    } //多个条件并集

    /**
     * exampleFilterConditions
     *
     * @return void
     */
    public function exampleFilterConditions()
    {
        // $conditions = [
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'eq' => '1',
        //     ], //等于
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'ne' => '1',
        //     ], //不等于
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'in' => ['1'],
        //     ], //包含
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'nin' => ['1'],
        //     ], //不包含
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'gt' => 1,
        //     ], //大于
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'gte' => 1,
        //     ], //大等于
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'lt' => 1,
        //     ], //小于
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'in' => 1,
        //     ], //小等于
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'em' => true,
        //     ], //是否为空
        //     'F::{table_alias.field_alias/field_id}' => [
        //         'or' => [
        //             [
        //                 'ne' => '1',
        //             ],
        //             [
        //                 'gt' => '2',
        //             ],
        //         ],
        //     ], //多个条件并集
        // ];
    }

    /**
     * exampleFilterSource
     *
     * @return void
     */
    public function exampleFilterSource()
    {
        // 创建人条件
        $body = [
            'field' => 'created_by',
            'query' => [
                'eq'  => [
                    11001,
                ],
                'ne'  => [
                    11001,
                ],
                'in'  => [
                    110011,
                    110012,
                    'myself',
                ],
                'nin' => [
                    110011,
                    110012,
                    'myself',
                ],
            ],
        ];

        // 创建时间
        $body = [
            'field' => 'created_on',
            'query' => [
                'eq'  => '2015-05-11',
                'ne'  => 'last_week',
                'gt'  => '2015-05-11',
                'lt'  => 'yesterday',
                'gte' => '2015-05-11',
                'lte' => '2015-05-11',
            ],
        ];
        // 文本字段
        $body = [
            'field' => 720002,
            'query' => [
                'eq'  => '匹配的文本',
                'ne'  => '不匹配的文本',
                'in'  => [
                    '匹配的文本1',
                    '匹配的文本2',
                ],
                'nin' => [
                    '不匹配的文本1',
                    '不匹配的文本2',
                ],
                'or'  => [
                    [
                        'eq' => '匹配的文本',
                    ],
                    [
                        'in' => [
                            '匹配的文本1',
                            '匹配的文本2',
                        ],
                    ],
                ],
                'em'  => true,
            ],
        ];
        // 数字字段和计算字段
        $body = [
            'field' => 720003,
            'query' => [
                'eq'  => 20,
                'ne'  => 20,
                'gt'  => 20,
                'lt'  => 20,
                'gte' => 20,
                'lte' => 20,
                'or'  => [
                    [
                        'eq' => 20,
                    ],
                    [
                        'gte' => 10,
                        'lt'  => 20,
                    ],
                ],
                'em'  => false,
            ],
        ];
        // 分类字段
        $body = [
            'field' => 720004,
            'query' => [
                'eq'  => [
                    1,
                    3,
                ],
                'ne'  => [
                    2,
                ],
                'in'  => [
                    1,
                    3,
                ],
                'nin' => [
                    1,
                    3,
                ],
                'em'  => true,
            ],
        ];
        // 时间字段
        $body = [
            'field' => 720005,
            'query' => [
                'eq'  => '2015-05-11',
                'ne'  => 'last_week',
                'gt'  => '2015-05-11',
                'lt'  => 'yesterday',
                'gte' => '2015-05-11',
                'lte' => '2015-05-11',
                'em'  => true,
            ],
        ];
        // 联系人字段
        $body = [
            'field' => 720006,
            'query' => [
                'eq'  => [
                    11001,
                ],
                'ne'  => [
                    11001,
                ],
                'in'  => [
                    110011,
                    110012,
                    'myself',
                ],
                'nin' => [
                    110011,
                    110012,
                    'myself',
                ],
                'em'  => true,
            ],
        ];
        // 图片字段
        $body = [
            'field' => 720007,
            'query' => [
                'em' => false,
            ],
        ];
        // 关联字段
        $body = [
            'field' => 720008,
            'query' => [
                'eq'  => [
                    21001,
                ],
                'ne'  => [
                    21001,
                ],
                'in'  => [
                    210011,
                    210012,
                ],
                'nin' => [
                    210011,
                    210012,
                ],
                'em'  => true,
            ],
        ];
        // 数据ID字段
        $body = [
            'field' => 'item_id',
            'query' => [
                'eq'  => 31001,
                'ne'  => 31001,
                'in'  => [
                    310011,
                    310012,
                ],
                'nin' => [
                    310011,
                    310012,
                ],
            ],
        ];
    }
}
