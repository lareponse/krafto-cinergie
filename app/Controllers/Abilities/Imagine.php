<?php

namespace App\Controllers\Abilities;

use \HexMakina\LocalFS\{FileSystem, File};

class Imagine
{
    private const DEFAULT_FILL = '000000';

    private const SUPPORTED_MIME = [
        'image/jpeg' => 'imagecreatefromjpeg',
        'image/png' => 'imagecreatefrompng',
        'image/gif' => 'imagecreatefromgif',
        'image/webp' => 'imagecreatefromwebp',
        'image/avif' => 'imagecreatefromavif',
        'image/bmp' => 'imagecreatefrombmp',
        'image/xbm' => 'imagecreatefromxbm',
        'image/xpm' => 'imagecreatefromxpm',
    ];

    private $originalImage;
    private File $file;

    private $fileSystem;
    private $pathToOriginalImage;
    private $quality = null;

    public function __construct(FileSystem $fileSystem, $pathToOriginalImage)
    {
        $this->fileSystem = $fileSystem;
        $this->pathToOriginalImage = $pathToOriginalImage;
        $this->file = new File($this->fileSystem->absolutePathFor($pathToOriginalImage));

        $this->originalImage = $this->createImageResource();
    }

    /**
     * Creates an image resource from the given path to the original image.
     *
     * @return resource The image resource.
     * @throws \Exception If the image type is not supported.
     */

    private function createImageResource()
    {
        $mimeType = $this->file->getMIMEType(true);

        if (!isset(self::SUPPORTED_MIME[$mimeType]))
            throw new \InvalidArgumentException('UNSUPPORTED_IMAGE_TYPE');

        $image = self::SUPPORTED_MIME[$mimeType]($this->file->path());

        if($image === false)
            throw new \InvalidArgumentException('UNSUPPORTED_IMAGE_TYPE');

        return $image;
    }


    public function setQuality(int $percentage)
    {
        $this->quality = $percentage;
    }

    public function createAlternateVersions($dimensions)
    {
        $originalImage = $this->originalImage;
        $originalWidth = imagesx($originalImage);
        $originalHeight = imagesy($originalImage);
    
        // $originalImageName = pathinfo($this->pathToOriginalImage, PATHINFO_FILENAME) . '.' . pathinfo($this->pathToOriginalImage, PATHINFO_EXTENSION);
        // $this->saveImage($originalImage, $originalImageName);

        foreach ($dimensions as $format => $dimension) {
            $expectedWidth = $dimension['width'];
            $expectedHeight = $dimension['height']; 
            // vd("$expectedWidth x $expectedHeight", 'expected');
            
            list($newWidth, $newHeight) = $this->calculateNewDimensions($originalWidth, $originalHeight, $dimension);
            
            $newImage = $this->resizeImage($originalImage, $newWidth, $newHeight);
            // if the new width or new height matches the original width or height, but the other dimension is bigger than the expected dimension, crop the image
            if (($newWidth == $expectedWidth && $newHeight > $expectedHeight) || ($newHeight == $expectedHeight && $newWidth > $expectedWidth)) {
                $newImage = $this->cropImage($newImage, $newWidth, $newHeight, $dimension);
                $newWidth = imagesx($newImage);
                $newHeight = imagesy($newImage);
                // vd("$newWidth x $newHeight", 'cropped');
            }
            else{
                // if the new width or new height matches the expected width or height, but the other dimenson is smaller than the expected dimension, slap it on black background that has the expected dimension
                $newImage = $this->addBackgroundIfNeeded($newImage, $newWidth, $newHeight, $expectedWidth, $expectedHeight, $dimension['fill'] ?? self::DEFAULT_FILL);
            }

            $this->saveImage($newImage, $format);

            imagedestroy($newImage);
            if ($originalImage !== $this->originalImage) {
                imagedestroy($originalImage);
            }
        }

        imagedestroy($this->originalImage);
    }

    private function saveImage($newImage, string $format)
    {
        $basename = pathinfo($this->pathToOriginalImage, PATHINFO_FILENAME);
        $dirname = pathinfo($this->pathToOriginalImage, PATHINFO_DIRNAME);
        $savePath = "{$dirname}/{$basename}/{$format}.jpg";
        $absoluteSavePath = $this->fileSystem->absolutePathFor($savePath);

        $this->fileSystem->ensureWritablePath($absoluteSavePath, $this->fileSystem->root());
        imagejpeg($newImage, $absoluteSavePath);
    }

    // write resizeImage method to resize image according to new dimensions
    private function resizeImage($originalImage, $newWidth, $newHeight)
    {
        $newImage = $this->createNewImage($originalImage, $newWidth, $newHeight);
        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($originalImage), imagesy($originalImage));
        return $newImage;
    }

    private function cropImage($originalImage, $newWidth, $newHeight, $dimension)
    {
        // if new width is bigger than dimension width, crop the width
        if ($newWidth > $dimension['width']) {
            $cropWidth = $newHeight * $dimension['width'] / $dimension['height'];
            $cropX = ($newWidth - $cropWidth) / 2;
            $originalImage = imagecrop($originalImage, ['x' => $cropX, 'y' => 0, 'width' => $cropWidth, 'height' => $newHeight]);
        } elseif ($newHeight > $dimension['height']) {
            $cropHeight = $newWidth * $dimension['height'] / $dimension['width'];
            $cropY = ($newHeight - $cropHeight) / 2;
            $originalImage = imagecrop($originalImage, ['x' => 0, 'y' => $cropY, 'width' => $newWidth, 'height' => $cropHeight]);
        }

        return $originalImage;
    }

    private function calculateNewDimensions($originalWidth, $originalHeight, $dimension)
    {
        // don't zoom on pictures that are smaller than the requested dimensions
        if ($originalWidth <= $dimension['width'] && $originalHeight <= $dimension['height']) {
            return [$originalWidth, $originalHeight];
        }

        // keep the proportions of the original image
        $ratio = $originalWidth / $originalHeight;

        $newWidth = $dimension['width'];
        $newHeight = $dimension['height'];

        if($newWidth < $originalWidth){
            // compute the new dimensions based on the width
            $newHeight = $newWidth / $ratio;
        }
        else{
            // compute the new dimensions based on the height
            $newWidth = $newHeight * $ratio;
        }


        if ((isset($dimension['max-width']) && $newWidth > $dimension['max-width'])
            || (isset($dimension['max-height']) && $newHeight > $dimension['max-height'])
        ) {
            if ($dimension['max-width'] && $newWidth > $dimension['max-width']) {
                $newWidth = $dimension['max-width'];
                $newHeight = $newWidth / $ratio;
            } else {
                $newHeight = $dimension['max-height'];
                $newWidth = $newHeight * $ratio;
            }
        }

        return [$newWidth, $newHeight];
    }

    private function createNewImage($originalImage, $newWidth, $newHeight)
    {
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        $black = imagecolorallocate($newImage, 0, 0, 0);
        imagefill($newImage, 0, 0, $black);
        $x = ($newWidth - imagesx($originalImage)) / 2;
        $y = ($newHeight - imagesy($originalImage)) / 2;
        imagecopyresampled($newImage, $originalImage, $x, $y, 0, 0, imagesx($originalImage), imagesy($originalImage), imagesx($originalImage), imagesy($originalImage));
        return $newImage;
    }

    /**
     * Adds black background to an image if its dimensions are not equal to the expected dimensions.
     *
     * @param resource $newImage The image resource to add black background to.
     * @param int $newWidth The width of the new image.
     * @param int $newHeight The height of the new image.
     * @param int $expectedWidth The expected width of the new image.
     * @param int $expectedHeight The expected height of the new image.
     * @return resource The new image with black background added if needed.
     */
    private function addBackgroundIfNeeded($newImage, int $newWidth, int $newHeight, int $expectedWidth, int $expectedHeight, string $hexFill)
    {
        if ($newWidth == $expectedWidth && $newHeight == $expectedHeight) {
            return $newImage;
        }
        elseif ($newWidth == $expectedWidth && $newHeight > $expectedHeight) {
            $newImage = $this->addBackground($newImage, $newWidth, $expectedHeight, $hexFill);
        }
        else{
            $newImage = $this->addBackground($newImage, $expectedWidth, $newHeight, $hexFill);
        }
        
        return $newImage;
    }

    private function addBackground($image, int $width, int $height, string $hexFill)
    {
        $newImage = imagecreatetruecolor($width, $height);

        // hexFill represents a color like FFFFFF or 000000, adapt the code to transcode it to RGB
        $r = hexdec(substr($hexFill, 0, 2));
        $g = hexdec(substr($hexFill, 2, 2));
        $b = hexdec(substr($hexFill, 4, 2));

        $black = imagecolorallocate($newImage, $r, $g, $b);
        imagefill($newImage, 0, 0, $black);

        $x = ($width - imagesx($image)) / 2;
        $y = ($height - imagesy($image)) / 2;

        imagecopy($newImage, $image, $x, $y, 0, 0, imagesx($image), imagesy($image));

        return $newImage;
    }
}
