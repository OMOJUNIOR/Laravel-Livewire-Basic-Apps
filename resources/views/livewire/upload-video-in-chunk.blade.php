<div class="bg-white h-screen w-screen sm:px-6 md:px-12 sm:py-6">
    <form x-on:submit.prevent="submit" x-data="{
    
        uploader: null,
        progress: 0,
        response: null,
    
        cancel() {
            this.uploader.abort()
    
            $nextTick(() => {
                this.uploader = null
                this.progress = 0
            })
        },
    
        submit() {
    
            console.log($refs.file.files[0])
            const file = $refs.file.files[0]
    
            if (!$refs.file.files[0]) {
                return alert('Please select a file')
            }
    
            this.uploader = createUpload({
                file: file,
                endpoint: '{{ route('upload.video') }}',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
    
    
                chunkSize: 2 * 1024,
    
            })
    
            this.uploader.on('progress', (progress) => {
                this.progress = progress.detail
    
            })
    
            this.uploader.on('chunkSuccess', (response) => {
                if (!response.detail.response.body) {
                    return
                }
                // making the file accessible for livewire
                $wire.call('handleUploadSuccess', file.name, JSON.parse(response.detail.response.body).file)
                console.log(JSON.parse(response.detail.response.body).file)
    
            })
    
            this.uploader.on('success', () => {
                this.uploader = null,
                    this.progress = 0
            })
    
            this.uploader.on('error', (error) => {
                console.log(error.detail)
                alert(error.detail)
            })
    
        }
    
    }" class="container mx-auto max-w-screen-lg h-full">
        <!-- file upload modal -->
        <article aria-label="File Upload Modal" class="relative flex flex-col bg-white shadow-xl rounded-md">
            <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
                <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                    <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                        <span>Upload </span>&nbsp;<span>Video</span>
                    </p>
                    <label
                        class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M17.5 2h-15C1.673 2 1 2.673 1 3.5v13c0 .827.673 1.5 1.5 1.5h15c.827 0 1.5-.673 1.5-1.5v-13c0-.827-.673-1.5-1.5-1.5zm-15 14c-.276 0-.5-.224-.5-.5v-13c0-.276.224-.5.5-.5h15c.276 0 .5.224.5.5v13c0 .276-.224.5-.5.5h-15z" />
                            <path d="M14 7h-4v4h-2v-4h-4v-2h4v-4h2v4h4v2z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Select a Video</span>
                        <input type='file' x-ref="file" class="hidden" />
                    </label>
                </header>
                <template x-if="uploader">
                    <div class="mt-8 space-y-1">
                        <span class="text-sm font-semibold text-gray-900">Uploading</span>
                        <div class="overflow-hidden h-3 rounded bg-gray-100">
                            <div x-bind:style="{ width: `${progress}%` }"
                                class="bg-blue-500 h-full transition-all duration-200">
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 text-sm">
                            <!-- pause button -->
                            <button type="button" x-on:click="!uploader.paused ? uploader.pause() : uploader.resume()"
                                x-text="!uploader.paused ? 'Pause' : 'Resume'"
                                class="text-blue-700 hover:text-blue-900"></button>
                            <button type="button" x-on:click="cancel"
                                class="text-red-700 hover:text-red-900">Cancel</button>
                        </div>

                    </div>


                </template>
            </section>
            <footer class="flex justify-end px-8 pb-8 pt-4">
                <button type= "submit"
                    class="rounded-sm px-3 py-1 bg-blue-700 hover:bg-blue-500 text-white focus:shadow-outline focus:outline-none">
                    Upload now
                </button>
            </footer>
        </article>
        <section class="overflow-hidden text-gray-700 bg-gray-200">
            <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                <div class="flex flex-wrap -m-1 md:-m-2">
                    @forelse(\App\Models\Video::all() as $video)
                        <div class="flex flex-wrap w-1/3">
                            <div wire:key='{{ $video->id }}' class="w-full p-1 md:p-2">
                                <h2 class="text-lg text-blue-900 font-medium title-font mb-4">{{ $video->file_name }}</h2>
                                <video class="w-full" controls>
                                    <source src="{{asset('storage/app/' . $video->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>

                                @if (!$video->file_path)
                                    <p class="text-red-500">Video file not found or invalid.</p>
                                @endif
                            </div>
                        </div>

                    @empty
                        <div class="flex flex-wrap w-1/3">
                            <div class="w-full p-1 md:p-2 text-red-500 ">
                                {{ __('No videos uploaded yet') }}
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </form>
</div>
