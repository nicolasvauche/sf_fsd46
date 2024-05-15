<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderService
{
    public function upload(UploadedFile $uploadedFile, string $directory, string $filename): string
    {
        $newFilename = $filename . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move('uploads/' . $directory, $newFilename);

        return $newFilename;
    }
}
