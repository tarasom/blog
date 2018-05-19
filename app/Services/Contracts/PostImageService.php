<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface PostImageService
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function store(UploadedFile $file): string;
}