@extends('layouts.app')

@section('content')
    <main class="mt-10">
        <a href="{{ route('blog.index') }}" class="ml-44 inline-flex items-center text-blue-600 hover:text-blue-800" aria-label="Kembali ke daftar blog">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>

        <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative aspect-[16/9]">
            <div class="absolute left-0 bottom-0 w-full h-full z-10 bg-gradient-to-t from-black/70 to-transparent"></div>
            
            <div class="relative w-full h-full overflow-hidden">

                <div class="mySlides hidden absolute inset-0 w-full h-full">
                    <img src="{{ asset('storage/' . $blog->feature_image) }}" 
                         alt="{{ $blog->title }}" 
                         class="w-full h-full object-cover" 
                         loading="lazy">
                </div>

                @foreach ($blog->detailImages as $image)
                    <div class="mySlides hidden absolute inset-0 w-full h-full">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="Detail gambar {{ $loop->iteration }} untuk {{ $blog->title }}" 
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                @endforeach

                <button class="absolute top-1/2 left-4 transform -translate-y-1/2 px-3 py-1 bg-black/50 text-white text-xl font-bold rounded-full cursor-pointer hover:bg-black/70 z-50 transition-colors duration-200"
                        onclick="plusSlides(-1)"
                        aria-label="Slide sebelumnya">
                    &#10094;
                </button>

                <button class="absolute top-1/2 right-4 transform -translate-y-1/2 px-3 py-1 bg-black/50 text-white text-xl font-bold rounded-full cursor-pointer hover:bg-black/70 z-50 transition-colors duration-200"
                        onclick="plusSlides(1)"
                        aria-label="Slide berikutnya">
                    &#10095;
                </button>
            </div>
        
            <div class="flex justify-center mt-4 space-x-2 absolute bottom-4 left-0 right-0 z-20">
                @php
                    $totalSlides = 1 + $blog->detailImages->count();
                @endphp
        
                @for ($i = 1; $i <= $totalSlides; $i++)
                    <button type="button"
                            class="dot w-3 h-3 bg-white/50 rounded-full cursor-pointer hover:bg-white/80 transition-colors duration-200"
                            onclick="currentSlide({{ $i }})"
                            aria-label="Pergi ke slide {{ $i }}"
                            aria-current="{{ $i === 1 ? 'true' : 'false' }}">
                    </button>
                @endfor
            </div>
        
            <!-- Title and date with better contrast -->
            <div class="p-4 absolute bottom-0 left-0 z-20 text-white">
                <h1 class="text-3xl md:text-4xl font-bold leading-tight">
                    {{ $blog->title }}
                </h1>
                <div class="flex mt-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <time datetime="{{ $blog->created_at->format('Y-m-d') }}" class="text-sm opacity-80">
                        {{ $blog->created_at->translatedFormat('d F Y') }}
                    </time>
                </div>
            </div>
        </div>
      
        <!-- Content with proper HTML escaping -->
        <article class="px-4 lg:px-0 mt-12 text-gray-800 max-w-screen-md mx-auto prose prose-lg">
            {!! $blog->content !!}
        </article>

        <!-- Action buttons with proper spacing and confirmation -->
        <div class="mt-12 flex gap-4 justify-center md:justify-start max-w-screen-md mx-auto px-4">
            <a href="{{ route('blog.edit', $blog->id) }}" 
               class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Edit Post
            </a>
            
            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Apakah Anda yakin ingin menghapus post ini?')"
                        class="px-6 py-2 text-white rounded-md bg-red-600 hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Hapus Post
                </button>
            </form>
        </div>
    </main>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);
        
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
        
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }
        
        function showSlides(n) {
            const slides = document.getElementsByClassName("mySlides");
            const dots = document.getElementsByClassName("dot");
            
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
        
            // Hide all slides
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.add("hidden");
            }
        
            // Remove active class from all dots
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("bg-white");
                dots[i].classList.add("bg-white/50");
                dots[i].setAttribute('aria-current', 'false');
            }
        
            // Show current slide and update dot
            slides[slideIndex - 1].classList.remove("hidden");
            dots[slideIndex - 1].classList.remove("bg-white/50");
            dots[slideIndex - 1].classList.add("bg-white");
            dots[slideIndex - 1].setAttribute('aria-current', 'true');
        }

        // Auto slide change (optional)
        // setInterval(() => plusSlides(1), 5000);
    </script>
@endsection