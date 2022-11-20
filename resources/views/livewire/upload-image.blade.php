<div class="bg-white h-screen w-screen sm:px-6 md:px-12 sm:py-6">
      <form wire:submit.prevent="save" class="container mx-auto max-w-screen-lg h-full">
        <!-- file upload modal -->
        <div>
       @if (session()->has('message'))
        <div class="bg-emerald-500 text-white py-3 px-4 mb-4">
            {{ session('message') }}
            </div>
        @endif     
     </div>
        <article aria-label="File Upload Modal" class="relative flex flex-col bg-white shadow-xl rounded-md">
          <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
            <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
              <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                <span>Upload </span>&nbsp;<span>Images Here</span>
              </p>
                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M17.5 2h-15C1.673 2 1 2.673 1 3.5v13c0 .827.673 1.5 1.5 1.5h15c.827 0 1.5-.673 1.5-1.5v-13c0-.827-.673-1.5-1.5-1.5zm-15 14c-.276 0-.5-.224-.5-.5v-13c0-.276.224-.5.5-.5h15c.276 0 .5.224.5.5v13c0 .276-.224.5-.5.5h-15z" />
                    <path d="M14 7h-4v4h-2v-4h-4v-2h4v-4h2v4h4v2z" />
                    </svg>
                    <span class="mt-2 text-base leading-normal">Select an Image</span>
                    <input type='file' class="hidden" wire:model="images" multiple />
                </label>
                @error('images.*') <span class="error">{{ $message }}</span> @enderror
            </header>

            <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
              Preview
            </h1>

            <div class="flex flex-wrap -mx-2">
              @foreach ($images as $image)
              <div class="w-1/2 md:w-1/3 lg:w-1/4 px-2 mb-4">
                <div class="relative">
                  <img src="{{ $image->temporaryUrl() }}" class="w-full h-48 object-cover rounded-md">
                  <div class="absolute top-0 right-0 p-2">
                    <button wire:click="remove({{ $loop->index }})" class="bg-white rounded-full p-1 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                      <span class="sr-only">Remove</span>
                      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 3a1 1 0 00-1 1v8a1 1 0 001 1h12a1 1 0 001-1v-8a1 1 0 00-1-1H4zm3 2a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              @endforeach
          </section>
          <footer class="flex justify-end px-8 pb-8 pt-4">
            <button  class="rounded-sm px-3 py-1 bg-blue-700 hover:bg-blue-500 text-white focus:shadow-outline focus:outline-none">
              Upload now
            </button>
          </footer>
        </article>
     <section class="overflow-hidden text-gray-700 ">
  <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
    <div class="flex flex-wrap -m-1 md:-m-2">
     @foreach($photos as $photo)
      <div class="flex flex-wrap w-1/3">
        <div class="w-full p-1 md:p-2">
          <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
            src="{{$photo}}">
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
      </form>
    </div>
    

 
