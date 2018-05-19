<?php

namespace App\Services;

use App\Services\Contracts\PostImageService as PostImageServiceInterface;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class PostImageService implements PostImageServiceInterface
{

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function store(UploadedFile $file): string
    {
        $baseName = md5($file->getClientOriginalName() . microtime());
        $fileName = $baseName . '.' . config('image.mime_type');

        $destinationPath = storage_path(sprintf('app/public/%1$s', $fileName));

        Image::make($file->getRealPath())
            ->fit(config('image.fit_width'), config('image.fit_height'), function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode(config('image.mime_type'), config('image.quality'))
            ->save($destinationPath);

        return $destinationPath;
    }
}