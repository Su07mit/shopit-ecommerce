<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class MediaService
{
  public static function upload(UploadedFile $file, String $folder = "uploads", String $name = ""): int
  {
    // File Name (Original Name)

    if (empty($name)) {
      $name = Str::slug($file->getClientOriginalName());
    }

    // File Extension

    $ext = $file->extension();

    // File Type (Mime Type)

    $type = $file->getMimeType();

    //  Folder Path

    $folderpath = "public/" . $folder;

    // Random File Name

    $path = Str::random(10) . mt_rand(1, 100) . "." . $ext;

    // Upload

    $file->storeAs($folderpath, $path);

    // Store to media table

    $media = Media::create([
      'name' => $name,
      'path' => $folder . "/" . $path,
      'type' => $type,
    ]);

    // Return media ID
    return $media->id;
  }
}
