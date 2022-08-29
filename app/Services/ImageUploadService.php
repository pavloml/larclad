<?php

namespace App\Services;

use App\Exceptions\ImageUploadException;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    protected int $postId;
    protected ImageService $imageService;
    protected string $imagePath;
    protected string $thumbnailPath;

    /**
     * @param UploadedFile $file
     * @param int $postId
     * @throws ImageUploadException
     */
    public function __construct(UploadedFile $file, $postId)
    {
        try {
            $this->postId = $postId;
            $this->imageService = new ImageService($file->path());
            $this->imagePath = '/post-images/' . $postId . pathinfo($file->hashName(), PATHINFO_FILENAME) . '.jpg';
            $this->thumbnailPath = '/post-images-tmb/' .$postId . pathinfo($file->hashName(), PATHINFO_FILENAME) . '.jpg';
            Storage::disk('public')->put($this->imagePath, $this->imageService->createPostImage());
            Storage::disk('public')->put($this->thumbnailPath, $this->imageService->createThumbnail());
        } catch (Exception $e) {
            throw new ImageUploadException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getArray()
    {
        return ['post_id' => $this->postId,
            'full_size_path' => $this->imagePath,
            'thumbnail_path' => $this->thumbnailPath,
            'format' => 'jpg',
            'width' => $this->imageService->imageOriginalWidth,
            'height' => $this->imageService->imageOriginalHeight,
            'is_main' => true];
    }
}
