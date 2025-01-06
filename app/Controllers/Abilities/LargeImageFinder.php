<?php

namespace App\Controllers\Abilities;

use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;
use \FilesystemIterator;

class LargeImageFinder
{
    private RecursiveIteratorIterator $iterator;
    private int $maxBytes;
    private int $maxHeight;
    private int $maxWidth;
    private $acceptableExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];


    public function __construct($directory)
    {
        // Create an iterator to loop through all subdirectories/files
        $this->iterator =  new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
    }

    public function setMaxBytes($maxBytes)
    {
        $this->maxBytes = $maxBytes;
    }

    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;
    }

    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;
    }

    public function setExtensionsFilter($acceptableExtensions)
    {
        $this->acceptableExtensions = $acceptableExtensions;
    }


    public function pathes(): array
    {
        $unoptimized = [];
        ini_set('gd.jpeg_ignore_warning', 1);

        foreach ($this->iterator as $file) {
            if ($file->isFile()) {

                $extension = strtolower($file->getExtension());

                // Check if the file is an image of an acceptable format
                if (in_array($extension, $this->acceptableExtensions)) {

                    try{

                        $imageInfo = @getimagesize($file->getPathname());

                    }catch(\Throwable $e){
                      dd('caught');
                    }

                    $unoptimized[$file->getPathname()] = [];

                    if (!isset($imageInfo[0]) || !isset($imageInfo[1])) {
                        $unoptimized[$file->getPathname()]['getimagesize'] = $imageInfo;
                    } else {
                        if (isset($this->maxWidth, $imageInfo[0]) && $imageInfo[0] > $this->maxWidth) {
                            $unoptimized[$file->getPathname()]['maxWidth'] = $imageInfo[0];
                        }

                        if (isset($this->maxHeight, $imageInfo[1]) && $imageInfo[1] > $this->maxHeight) {
                            $unoptimized[$file->getPathname()]['maxHeight'] = $imageInfo[1];
                        }
                    }

                    $fileSize  = $file->getSize();
                    // Check file size against the threshold
                    if (isset($this->maxBytes) && $fileSize > $this->maxBytes) {
                        $unoptimized[$file->getPathname()]['maxBytes'] = $fileSize;
                    }
                }
            }
            if(empty($unoptimized[$file->getPathname()])) {
                unset($unoptimized[$file->getPathname()]);
            }
            else{
                $unoptimized[$file->getPathname()] ['imageInfo'] = $imageInfo;
            }
        }

        return $unoptimized;
    }
}
