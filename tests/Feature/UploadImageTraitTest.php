<?php

use Illuminate\Support\Facades\Storage;

it('will return no-image file error', function () {
    // dummy file
    $file = \Illuminate\Http\UploadedFile::fake()->create('video.mp4');

    // perform upload
    $response = \App\Traits\UploadImage::upload($file);

    // assert it will return no-image file error
    expect($response)->toBe(['error' => 'the provided file is not an image']);
});


it('will not upload if the file already exist', function () {
    // fake disk
    Storage::fake('public');

    // Arrange
    $filename = 'thumbnail.png';
    $dir = 'images/articles/thumbnails/';

    // dummy image
    $image = \Illuminate\Http\UploadedFile::fake()->image($filename);

    // an image is already exist
    Storage::disk('public')->putFileAs($dir, $image, $filename);

    // upload
    $response = \App\Traits\UploadImage::upload($image, $filename, $dir);

    // assert it will return error message
    expect($response)->toBe(['error' => 'there is already a file with the same provided name']);
});

it('able to upload image', function () {
    // fake disk
    Storage::fake('public');

    // Arrange
    $filename = 'thumbnail.png';
    $dir = 'images/articles/thumbnails/';

    // dummy image
    $image = \Illuminate\Http\UploadedFile::fake()->image($filename);

    // upload
    $image_path = \App\Traits\UploadImage::upload($image, $filename, $dir);

    // assert its return the image path
    $this->assertArrayHasKey('path', $image_path);

    // assert that the image exist
    Storage::disk('public')->assertExists($dir . $filename);
});
