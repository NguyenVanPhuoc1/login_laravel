<?php 
namespace App\Services;

use App\Contracts\FileStorageInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileStorageService implements FileStorageInterface
{
    public function upload_file($file, $directory)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::uuid() . '.' . $extension;

        Storage::disk('public')->putFileAs($directory, $file, $fileName);

        return "/storage/$directory/$fileName";
    }

    public function remove_file($filePath)
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }

        return false;
    }
}
