<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImage extends Component
{
    use WithFileUploads;

    public $images = [];

    public function save()
    {
        $this->validate([
            'images.*' => 'image|max:4024', // 4MB Max
        ]);

        foreach ($this->images as $image) {
            $image->store('public');
        }

        session()->flash('message', 'Image Uploaded Successfully.');

        $this->images = [];
    }

    public function remove($index)
    {
        $this->images = array_values(array_filter($this->images, function ($value, $key) use ($index) {
            return $key != $index;
        }, ARRAY_FILTER_USE_BOTH));
    }

    public function render()
    {
        return view('livewire.upload-image', [
            'photos' => collect(Storage::files('public'))
                ->filter(function ($file) {
                    return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'gif', 'webp']);
                })
                ->map(function ($file) {
                    return Storage::url($file);
                }),
        ]);
    }
}
