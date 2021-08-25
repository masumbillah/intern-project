<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageStore{

    function imageSave($folder,$file){
        if(request()->hasFile('image')){
            $file_name = $folder.'/'.uniqid().'.'.$file->extension();
            Storage::put($file_name,file_get_contents($file));
            return $file_name;
        }else{
            return 'https://via.placeholder.com/350x150';
        }
    }

    function imageUpdate($folder,$file){
        if(request()->hasFile('image')){
            $file_name = $folder.'/'.uniqid().'.'.$file->extension();
            Storage::put($file_name,file_get_contents($file));
            return $file_name;
        }
    }

    function imageDelete($url){
        // if(request()->hasFile('image')){
        //     $file_name = $folder.'/'.uniqid().'.'.$file->extension();
        //     Storage::put($file_name,file_get_contents($file));
        //     return $file_name;
        // }else{
        //     return 'https://via.placeholder.com/350x150';
        // }
    }
}




