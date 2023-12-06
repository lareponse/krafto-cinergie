<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Submission extends TightModel
{
    public function __construct()
    {
        $this->set('emitted', json_encode(self::emitterInfo()));
    }

    public static function emitterInfo(): array
    {
        $serverKeys = [
            'REMOTE_ADDR',
            'HTTP_USER_AGENT',
            'HTTP_REFERER',
            'REQUEST_URI',
            'REQUEST_METHOD',
            'REQUEST_TIME',
            'REQUEST_TIME_FLOAT',
            'HTTP_ACCEPT',
            'HTTP_ACCEPT_ENCODING',
            'HTTP_ACCEPT_LANGUAGE',
            'HTTP_HOST'
        ];

        $trace = [];
        foreach ($serverKeys as $key) {
            $trace[$key] = $_SERVER[$key];
        }

        return $trace;

    }
}