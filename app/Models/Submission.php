<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Submission extends TightModel
{
    /**
     * Retrieves information about the emitter.
     *
     * This method returns an array containing various server-related information
     * about the emitter, such as the IP address, user agent, referer, request URI,
     * request method, request time, and more.
     *
     * @return array An associative array containing the emitter information.
     */

    public function __toString()
    {
        return $this->get('urn');
    }
    public function record()
    {
        list($type, $id) = explode(':', $this->get('urn'));
        $class = '\\App\\Models\\' . $type;

        if(!empty($class) && !empty($id))
            return $class::exists($id);

        return null;
    }   

    public static function submittedBy(): array
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