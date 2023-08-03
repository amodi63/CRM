<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait Image {
    public function storeImage(Request $request, $image_name,$place, $disk = 'public')
    {
        
        if (!$request->hasFile($image_name)) {
            return;
        }
        $file = $request->file($image_name);
        $path = $file->store($place, $disk);
        return $path;
    }
    public function updateImage(Request $request, $object, $image_name, $place, $disk = 'public')
    {
        $new_path = null;
        
        if ($request->hasFile($image_name)) {
            $new_path = $request->file($image_name)->store($place, $disk);
            
        }
         
        if ($new_path && $new_path !== $object->{$image_name}) {
            $this->deleteImage($object->{$image_name}, $disk);
        } else {
            $new_path = $object->{$image_name};
        }
        
        return $new_path;
    }
    
    
    
    public static function deleteImage( $path,$disk ='public')
    {
        if ($path)
            Storage::disk($disk)->delete($path);
    }

  
}