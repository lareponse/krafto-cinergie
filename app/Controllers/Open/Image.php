<?php

namespace App\Controllers\Open;

class Image extends Home
{
    public function legacy()
    {
        $path = $this->router()->params('path');

        $absolutePath = $this->supportSEODash($path) ?? $this->supportDefaultImage();
        // dd($absolutePath, 'absolutePath');
        // Serve the default image if the requested one isn't found
        if ($absolutePath !== null) {
            $this->serveImageWithCaching($absolutePath);
            exit;
        }

        // Fallback to 404 if even the default image is missing
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    private function sanitizePath(string $absolutePath, string $baseDir): ?string
    {
        // Normalize the base directory and ensure it ends with a directory separator
        $baseDir = realpath($baseDir);
        if ($baseDir === false) {
            return null; // Base directory does not exist
        }
        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        // Resolve the absolute path and ensure it exists
        $absolutePath = realpath($absolutePath);
        if ($absolutePath === false) {
            return null; // Path does not exist
        }

        // Ensure the resolved path is within the base directory
        if (strpos($absolutePath, $baseDir) !== 0) {
            return null; // Path is outside the base directory
        }

        // Ensure the path is not a symlink (to prevent symlink attacks)
        if (is_link($absolutePath)) {
            return null; // Path is a symlink
        }

        return $absolutePath;
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

        if (!isset($parts['dirname'], $parts['filename'], $parts['extension'])) {
            return null;
        }
        
        $parentDir = basename($parts['dirname']);
        $grandparentDir = dirname($parts['dirname']);
        $replace = $parentDir . DIRECTORY_SEPARATOR . $parts['filename'];

        $possibleFilenames = [
            $replace,
            str_replace('_', '-', $replace)
        ];

        foreach (array_unique($possibleFilenames) as $filename) {
            $relativePath = $grandparentDir . DIRECTORY_SEPARATOR . $filename . '.' . $parts['extension'];
            $absolutePath = $this->get('settings.folders.images') . DIRECTORY_SEPARATOR . $relativePath;

            if (file_exists($absolutePath) && $this->sanitizePath($absolutePath, $this->get('settings.folders.images')) !== null) {
                return $absolutePath;
            }
        }

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
