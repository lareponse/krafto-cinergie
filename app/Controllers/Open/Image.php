<?php

namespace App\Controllers\Open;

class Image extends Home
{


    public function legacy()
    {
        
        $path = $this->router()->params('path');
        $parts = pathinfo($path);
        
        foreach($this->possibleFileNames($parts) as $filename) {
            $relativePath = $parts['dirname'] . DIRECTORY_SEPARATOR . $filename . '.' . $parts['extension'];
            $absolutePath = $this->get('settings.folders.images') . DIRECTORY_SEPARATOR . $relativePath;
            if (file_exists($absolutePath)) {
                header("HTTP/1.1 301 Moved Permanently");
                header('Location: ' . $this->get('settings.urls.images') . DIRECTORY_SEPARATOR . $relativePath);
                exit;
            }
        }

        header("HTTP/1.1 301 Moved Permanently");
        header('Location: ' . $this->get('settings.urls.default_image'));
        exit;

        // header("HTTP/1.1 404 Moved Permanently");
        // exit;
    }

    private function possibleFileNames($parts)
    {
        return array_unique([
                $parts['filename'], 
                str_replace('_', '-', $parts['filename'])
            ]);
    }
}
