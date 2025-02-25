<?php

namespace App\Controllers\Abilities;

class ImageScanner
{
    private $root_path;

    public function __construct(string $root_path)
    {
        $this->root_path = $root_path;
    }

    public function scan($directory = null)
    {
        $directory ??= $this->root_path;
        $ret = [];
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue; // Skip current and parent directory references
            }

            $filePath = $directory . DIRECTORY_SEPARATOR . $file;

            if (is_link($filePath)) {
                continue; // Skip symbolic links
            }

            if (is_dir($filePath)) {
                // Recursively scan subdirectories and merge results
                $ret = array_merge($ret, $this->scan($filePath));
            } elseif (is_file($filePath)) {
                $ret[] = $this->analyse($filePath);
            }
        }
        return $ret;
    }

    // Function to process image files and insert metadata into the database
    public function analyse($filePath)
    {
        $ret = [];

        $ret['path'] = str_replace($this->root_path, '', $filePath);
        $ret['name'] = basename($filePath);
        $ret['size'] = filesize($filePath);
        $ret['extension'] = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // Define a custom error handler
        set_error_handler(function ($errno, $errstr) use (&$ret) {
            $ret['error'] = $errstr;
            $ret['width'] = null;
            $ret['height'] = null;
        });

        // Attempt to get image info
        $fileInfo = getimagesize($filePath);

        // Restore the original error handler
        restore_error_handler();
        if (is_array($fileInfo)) {
            $ret['mime'] = $fileInfo['mime'];
            $ret['width'] = $fileInfo[0];
            $ret['height'] = $fileInfo[1];
        } else {
            $ret['mime'] = (new \finfo(FILEINFO_MIME_TYPE))->file($filePath);
        }

        return $ret;
    }
}
