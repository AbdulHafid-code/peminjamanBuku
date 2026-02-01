<?php

namespace App\Helper;

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

        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs($pathSave, $fileName, 'public');

        return $fileName;
    }
}