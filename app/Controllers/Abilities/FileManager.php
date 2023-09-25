<?php
namespace App\Controllers\Abilities;

use \ZipArchive;
use \InvalidArgumentException;
use \Exception;

class FileManager
{
    private $rootDirectory;
    private $archiveDirectory;
    private $rootURL;

    public function __construct(string $rootDirectory, string $archiveDirectory = null)
    {
        $this->rootDirectory = realpath($rootDirectory);
        $this->archiveDirectory = $archiveDirectory ? realpath($archiveDirectory) : null;
    }

    public function setArchiveDirectory(string $archiveDirectory): void
    {
        $this->archiveDirectory = realpath($archiveDirectory);
    }

    public function setRootURL(string $rootURL): void
    {
        $this->rootURL = filter_var($rootURL, FILTER_SANITIZE_URL);
    }

    public function listFiles(string $relativePath): array
    {
        $absolutePath = $this->absolutePathFor($relativePath);
        if (!$absolutePath || !is_dir($absolutePath)) {
            return [];
        }
        return array_diff(scandir($absolutePath), ['.', '..']);
    }

    public function removeFile(string $relativePath): void
    {
        $path = $this->absolutePathFor($relativePath);
        if (!$path || !file_exists($path)) {
            throw new InvalidArgumentException('File does not exist.');
        }
        if (!is_file($path)) {
            throw new InvalidArgumentException('Path does not match a file.');
        }
        if (!unlink($path)) {
            throw new Exception('Unable to remove file.');
        }
    }

    public function createZipOfDirectory(string $relativePath): void
    {
        $absolutePath = $this->absolutePathFor($relativePath);
        if (!$absolutePath || !is_dir($absolutePath) || !$this->archiveDirectory) {
            return;
        }
        $zip = new ZipArchive();
        $zipFileName = "{$this->archiveDirectory}/" . basename($absolutePath) . '.zip';
        if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {
            $files = $this->listFiles($absolutePath);
            foreach ($files as $file) {
                $zip->addFile("$absolutePath/$file", $file);
            }
            $zip->close();
        }
    }

    public function removeDirectory(string $relativePath): void
    {
        $absolutePath = $this->absolutePathFor($relativePath);
        if ($this->archiveDirectory) {
            $this->createZipOfDirectory($absolutePath);
        }
        if (!$absolutePath || !is_dir($absolutePath)) {
            return;
        }
        array_map('unlink', glob("$absolutePath/*"));
        rmdir($absolutePath);
    }

    public function absolutePathFor(string $relativePath): ?string
    {
        $absolutePath = realpath("{$this->rootDirectory}/{$relativePath}");
        return $absolutePath && strpos($absolutePath, $this->rootDirectory) === 0 ? $absolutePath : null;
    }

    public function absoluteURLFor(string $relativePath): string
    {
        return filter_var("{$this->rootURL}/{$relativePath}", FILTER_SANITIZE_URL);
    }
}
