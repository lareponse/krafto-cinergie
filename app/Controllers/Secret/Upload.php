<?php

namespace App\Controllers\Secret;

class Upload extends Krafto
{
    public function upload()
    {
        dd($_SERVER['HTTP_REFERER']);
    }
}
