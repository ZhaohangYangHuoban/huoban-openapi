<?php

declare(strict_types=1);
/*
 * @Author: ZhaohangYang <yangzhaohang@comsenz-service.com>
 * @Date: 2021-05-25 10:26:41
 * @Description: 伙伴智慧大客户研发部
 */

namespace HuobanOpenApi\Models\Basic;

use HuobanOpenApi\Contracts\HuobanRequestInterface;

class HuobanBasic
{
    public $request;

    public function __construct(HuobanRequestInterface $request)
    {
        $this->request = $request;
    }
}
