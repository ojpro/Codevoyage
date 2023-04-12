<?php

namespace App\Traits;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadImage
{
    protected static string $default_dir = 'images/';

    /**
     * Upload an image and return its path
     *
     * @param UploadedFile $file
     * @param string|null $filename
     * @param string|null $dir
     * @return array|null
     * @throws \Exception
     */
    public static function upload(UploadedFile $file, string $filename = null, string $dir = null): array|null
    {
        // Check that the file is an image
        if (!$file->isFile() or !self::isImage(new File($file))) {
            // the provided file is not an image
            return ['error' => 'the provided file is not an image'];
        }

        // generate a random name for it if not provided
        if ($filename === null) {
            $file_extension = $file->getClientOriginalExtension();
            $current_time = time();
            $filename = 'image-' . $current_time . '.' . $file_extension;
        }

        // set the dir if it does not exist
        if ($dir === null) {
            $dir = self::$default_dir;
        }

        // check if the file already exist
        // TODO : handle the slash in dir variable
        if (Storage::disk('public')->exists($dir . $filename)) {
            return ['error' => 'there is already a file with the same provided name'];
        }

        // store the file
        Storage::disk('public')->putFileAs($dir, $file, $filename);

        // return the path of the image
        return ['path' => 'storage/' . $dir . $filename];
    }

    // method to check if a file is an image
    protected static function isImage(File $file): bool
    {
        // possible mime types for an image
        $image_mimes = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/x-png', 'image/webp', 'image/bmp'];

        // check that the file is an image using the mime types
        if (in_array($file->getMimeType(), $image_mimes)) {
            return true;
        }
        return false;
    }
}
