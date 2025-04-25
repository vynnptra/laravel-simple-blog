@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="font-semibold text-2xl text-gray-800">Edit Post</h1>

    <div class="w-full bg-white rounded-lg shadow-md p-6 mt-6">
        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" id="title" name="title" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('title') ? old('title') : $blog->title  }}"  />
                    @error('title')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div class="mb-4">
                    <label for="feature_image" class="block text-gray-700 font-medium mb-2">Thumbnail</label>
                    <input type="file" id="feature_image" name="feature_image" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"  value="{{ old('thumbnail') ? old('thumbnail') : $blog->thumbnail  }}" />
                           @error('feature_image')
                           <p class="text-sm text-red-500">{{ $message }}</p>
                       @enderror
                </div>
            </div>

            {{-- Content Editor --}}
            <div class="mt-6">
                <label class="block text-gray-700 font-medium mb-2">Blog Content</label>
                <div id="editor-container" class="mb-4">
                    <!-- Quill editor will be inserted here -->
                    <div class="quill-editor h-96" data-input-id="content"></div>
                    <input type="hidden" id="content" name="content" value="{{ old('content') ? old('content') : $blog->content  }}" >
                    @error('content')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="button" 
                class="px-6 py-2 bg-indigo-600 text-white rounded-md mb-2 hover:bg-indigo-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="addImage">
                    Add detail image
                </button>
                <div id="container"  >
                    {{-- <input type="file" name="image_path[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"> --}}
                    {{-- <button type="button" id="removeBtn" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">-</button> --}}
                    @error('image_path')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                     @enderror
                </div>
            </div>

            <div class="mt-8 flex gap-4 justify-end">
                <a href="{{ route('blog.index') }}" 
                        class="px-6 py-2  text-gray-700 rounded-md hover:bg-gray-100 border border-gray-400 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save Post
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    const addBtn = document.getElementById('addImage');

    addBtn.addEventListener('click', function () {
        const container = document.getElementById('container');

        const wrapper = document.createElement('div');
        wrapper.classList.add('mt-2', 'flex', 'gap-3');

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'image_path[]';
        input.classList.add('w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500');

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = '-';
        removeBtn.classList.add('px-6', 'py-2', 'bg-gray-600', 'text-white', 'rounded-md', 'hover:bg-gray-700', 'transition-colors', 'duration-200', 'focus:outline-none', 'focus:ring-2', 'focus:ring-gray-500', 'focus:ring-offset-2');

        // Pasang event listener untuk menghapus elemen wrapper
        removeBtn.addEventListener('click', function () {
            container.removeChild(wrapper);
        });

        wrapper.appendChild(input);
        wrapper.appendChild(removeBtn);
        container.appendChild(wrapper);
    });
</script>


@endsection