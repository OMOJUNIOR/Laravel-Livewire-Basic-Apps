<?php

namespace App\Http\Livewire;

use App\Http\Livewire\UploadVideoInChunk;
use Illuminate\Http\UploadedFile;
use App\Models\Video;
use Illuminate\Support\Str;


class UniqueVideoUpload extends UploadVideoInChunk
{
   public function onSuccess(UploadedFile $file)
   {
         Video::create([
              'file_name' => $file->getClientOriginalName(),
              'file_path' => $file->storeAs('videos',Str::uuid().'.'.$file->getClientOriginalExtension()),
         ]);
    
   }
}
