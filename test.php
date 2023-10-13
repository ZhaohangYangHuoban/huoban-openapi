<?php

require( dirname( __FILE__ ) . '/vendor/autoload.php' );

use \HuobanOpenApi\Helpers\HuobanTools;
use \HuobanOpenApi\Helpers\HuobanFilter;
use \HuobanOpenApi\Request\GuzzleRequest;

use \HuobanOpenApi\HuobanOpenApi;
use \HuobanOpenApi\Models\HuobanItem;


// stup
$huobanRequest = new GuzzleRequest( $config = [] );
$huobanOpenapi = new HuobanOpenApi( $huobanRequest );

$huobanItem = $huobanOpenapi->getHuobanOpenapiItem();
$item       = $huobanItem->get( $item_id = '' );