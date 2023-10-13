<?php

namespace HuobanOpenApi\Contracts;

interface HuobanConfigInterface
{
    public function getName() : string;
    public function getApiKey() : string;
    public function getApiUrl() : string;
}