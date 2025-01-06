<?php

namespace App\Controllers\Open;

class Image extends Home
{
    public function legacy()
    {
        $path = $this->router()->params('path');
        $parts = pathinfo($path);

        foreach ($this->possibleFileNames($parts) as $filename) {
            $relativePath = $parts['dirname'] . DIRECTORY_SEPARATOR . $filename . '.' . $parts['extension'];
            $absolutePath = $this->get('settings.folders.images') . DIRECTORY_SEPARATOR . $relativePath;

            if (file_exists($absolutePath)) {
                $this->serveImageWithCaching($absolutePath);
                exit;
            }
        }

        // Serve the default image if the requested one isn't found
        $defaultImagePath = $this->get('settings.folders.default_image');
        if (file_exists($defaultImagePath)) {
            $this->serveImageWithCaching($defaultImagePath);
            exit;
        }

        // Fallback to 404 if even the default image is missing
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    private function serveImageWithCaching($absolutePath)
    {
        // Get the file's last modification time
        $lastModifiedTime = filemtime($absolutePath);
        $etag = md5_file($absolutePath);

        // Check if the client already has a cached version
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModifiedTime) {
            header("HTTP/1.1 304 Not Modified");
            exit;
        }

        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
            header("HTTP/1.1 304 Not Modified");
            exit;
        }

        // Set caching headers
        header('Cache-Control: max-age=31536000, public'); // Cache for 1 year
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModifiedTime) . ' GMT');
        header('ETag: ' . $etag);
        header('Content-Type: ' . mime_content_type($absolutePath));
        header('Content-Length: ' . filesize($absolutePath));

        // Serve the file content
        readfile($absolutePath);
    }

    private function possibleFileNames($parts)
    {
        return array_unique([
                $parts['filename'], 
                str_replace('_', '-', $parts['filename'])
            ]);
    }
}
