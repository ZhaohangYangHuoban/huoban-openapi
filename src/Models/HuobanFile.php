<?php

namespace HuobanOpenApi\Models;

use HuobanOpenApi\Models\Basic\HuobanBasic;

class HuobanFile extends HuobanBasic
{
    /**
     * 上传文件
     *
     * @param array $options
     * @return array
     */
    public function upload( $body = [], $options = [] ) : array
    {
        //  example
        //  $body = [
        //      'multipart' => [
        //          [
        //              'contents' => fopen($file_path . '/' . $file_name, 'r'),
        //              'name'     => 'source',
        //          ],
        //          [
        //              'name'     => 'type',
        //              'contents' => 'attachment',
        //          ],
        //          [
        //              'name'     => 'name',
        //              'contents' => $file_name,
        //          ],
        //      ],
        //  ];
        return $this->request->fileUpload( 'POST', "/file/upload", $body, $options );
    }
}