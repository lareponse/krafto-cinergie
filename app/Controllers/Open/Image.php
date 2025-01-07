<?php

namespace App\Controllers\Open;

class Image extends Home
{
    public function legacy()
    {
        $path = $this->router()->params('path');

        $absolutePath = $this->supportSEODash($path) ?? $this->supportDefaultImage();
        // Serve the default image if the requested one isn't found
        if($absolutePath !== null) {
            $this->serveImageWithCaching($absolutePath);
            exit;
        }
        
        // Fallback to 404 if even the default image is missing
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    private function supportDefaultImage(): ?string
    {
        $defaultImagePath = $this->get('settings.folders.default_image');
        if ($defaultImagePath && file_exists($defaultImagePath)) {
            return $defaultImagePath;
        }
        return null;
    }

    private function supportSEODash($path): ?string
    {
        $parts = pathinfo($path);

        // Validate that the required keys exist
        if (!isset($parts['dirname'], $parts['filename'], $parts['extension'])) {
            return null; // Invalid path
        }

        // Generate possible filenames
        $parentDir = basename($parts['dirname']);
        $grandparentDir = dirname($parts['dirname']); // Path excluding the direct parent directory
        $replace = $parentDir.DIRECTORY_SEPARATOR.$parts['filename'];

        $possibleFilenames = [
            $replace,
            str_replace('_', '-', $replace)
        ];

        // Iterate through possible filenames
        foreach (array_unique($possibleFilenames) as $filename) {
            $relativePath = $grandparentDir . DIRECTORY_SEPARATOR . $filename . '.' . $parts['extension'];
            $absolutePath = $this->get('settings.folders.images') . DIRECTORY_SEPARATOR . $relativePath;

            // Check if the file exists
            if (file_exists($absolutePath)) {
                return $absolutePath; // Return the first valid absolute path
            }
        }

        // Return null if no valid path is found
        return null;
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
}
