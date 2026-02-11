<?php

namespace App\Helper;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageHelper {

    public function deleteImage($fileOld) {
        if ($fileOld && Storage::disk('public')->exists($fileOld)) {
            Storage::disk('public')->delete($fileOld);
        }
    }

    public function uploadImage($file, $pathSave, $oldImage = null) {
        if ($oldImage) {
            $this->deleteImage($pathSave . $oldImage);
        }

        $extension = $file->getClientOriginalExtension();

        $fileName = time() . '_' . Str::random(10) . $extension;
        $file->storeAs($pathSave, $fileName, 'public');

        return $fileName;
    }
}