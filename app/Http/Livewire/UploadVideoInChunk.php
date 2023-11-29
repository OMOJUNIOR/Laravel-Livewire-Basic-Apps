<?php

namespace App\Http\Livewire;

use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Livewire\Component;
use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\ContentRangeUploadHandler;
use Illuminate\Http\UploadedFile;
use App\Models\Video;


class UploadVideoInChunk extends Component
{

    public $videos = [];

    public function mount(){

       if(!method_exists($this, 'onSuccess')){
           throw new \Exception('Please add onSuccess method to your '.get_class($this));
       }
       
    }


    public function render()
    {
        return view('livewire.upload-video-in-chunk');
    }


    public function handleUploadSuccess($name,$filePath){

        //since we are using name, we to look for the file in the storage folder.

        $this->onSuccess(new UploadedFile(storage_path('app/chunks/' . $filePath),$name));

    }


    public function handleUpload(Request $request){

        $receiver = new FileReceiver(
        UploadedFile::fake()->createWithContent('file',$request->getContent()),
        $request, 
        ContentRangeUploadHandler::class);

        $save = $receiver->receive();

        if($save->isFinished()){
            
            return response()->json([
               // 'file' => $save->getFile()->getRealPath() // this is not good for production  
                'file' => $save->getFile()->getFilename() // for best security practices use this instead
            ]);
        }

        $save->handler();
        
    }
}
