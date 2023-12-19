<?php

require( dirname( __FILE__ ) . '/vendor/autoload.php' );

use \HuobanOpenApi\Helpers\HuobanTools;
use \HuobanOpenApi\Helpers\HuobanFilter;
use \HuobanOpenApi\Request\GuzzleRequest;

use \HuobanOpenApi\HuobanOpenApi;
use \HuobanOpenApi\Models\HuobanItem;


// stup
$huobanRequest = new GuzzleRequest( $config = [] );
$HuobanOpenApi = new HuobanOpenApi( $huobanRequest );

$huobanItem = $HuobanOpenApi->getHuobanOpenApiItem();
$item       = $huobanItem->get( $item_id = '' );