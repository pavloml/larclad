<?php

namespace App\Services;

use \Imagick;
use ImagickException;

class ImageService
{
    private Imagick $image;
    private string $imageOriginalWidth;
    private string $imageOriginalHeight;


    /**
     * @throws ImagickException
     */
    public function __construct(string $filepath)
    {
        $this->image = new Imagick($filepath);
        $this->imageOriginalWidth = $this->image->getImageWidth();
        $this->imageOriginalHeight = $this->image->getImageHeight();
    }

    public function __get($property) {
        if (property_exists($this, $property) && $property !== "image") {
            return $this->$property;
        }
    }

    /**
     * @throws ImagickException
     * @return string JPG image blob
     */
    public function createPostImage() {
        $this->image->setBackgroundColor('white');
        $this->image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
        $this->image->setImageFormat('jpg');
        $this->image->setImageCompressionQuality(80);
        return $this->image->getImageBlob();
    }

    /**
     * @throws ImagickException
     * @return string JPG image blob
     */
    public function createThumbnail() {
        $this->image->thumbnailImage(250, 170);
        return $this->image->getImageBlob();
    }
}
