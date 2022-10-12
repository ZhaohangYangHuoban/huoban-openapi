<?php

namespace HuobanOpenapi\Models;

use HuobanOpenapi\Models\HuobanBasic;

class HuobanFile extends HuobanBasic
{
    /**
     * 上传文件
     *
     * @param array $options
     * @return array
     */
    public function upload($body = [], $options = []): array
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
        $response = $this->request->fileUpload('POST', "/file/upload", $body, $options);
        return $response['data']['file_id'] ?? $response;
    }

}
