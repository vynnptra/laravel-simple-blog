@extends('layouts.app')

@section('content')



<div class="w-full h-[30rem] rounded-md p-4 ">
    
    @if ($blogs->count())
    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-y-10 gap-x-6 items-start p-8">

        @foreach ($blogs as $blog)
        {{-- <div class="pb-8 grid grid-cols-3 border">
            <img src="{{ asset('storage/'.$blog->feature_image) }}" alt="" class=" mx-auto rounded-md w-[47rem] h-[30rem] col-span-1">
            <div class="col-span-2">
                <h1 class=" text-blue-900 text-5xl font-bold text-center mb-4">{{ $blog->title }}</h1>
                <h3 class="text-sm text-center text-gray-700 mb-4">{{ $blog->created_at->translatedFormat('d F Y') }} </h3>
                <p class="text-lg  text-blue-950 mt-5">{!! Str::limit($blog->content, 300) !!}</p>
                <a href="" class="mt-4 py-2 px-4 bg-blue-500 hover:bg-blue-700 rounded-3xl text-white mx-auto justify-self-center col-span-3">Read More</a>
            </div>
        </div> --}}

                <!-- inspired by tailwindcss.com -->
            <li class="relative flex flex-col sm:flex-row xl:flex-col items-start border rounded border-gray-300 p-3">
                <div class="order-1 sm:ml-6 xl:ml-0">
                    <h3 class="mb-1 text-slate-900 font-semibold">
                        <span class="mb-1 block text-sm leading-6 text-cyan-500">{{$blog->title}}
                    </h3>
                    <div class="prose prose-slate prose-sm text-slate-600">
                        <p>{!! Str::limit($blog->content, 150) !!}</p>
                    </div><a
                        class="group inline-flex items-center h-9 rounded-full text-sm font-semibold whitespace-nowrap px-3 focus:outline-none focus:ring-2 bg-slate-100 text-slate-700 hover:bg-slate-200 hover:text-slate-900 focus:ring-slate-500 mt-6"
                        href="{{ route('blog.show', $blog->id) }}">Learn
                        more<span class="sr-only">, Seamless SVG background patterns by the makers of Tailwind CSS.</span>
                        <svg class="overflow-visible ml-3 text-slate-300 group-hover:text-slate-400"
                            width="3" height="6" viewBox="0 0 3 6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M0 0L3 3L0 6"></path>
                        </svg></a>
                </div>
                <img src="{{ asset('storage/'.$blog->feature_image) }}" alt="" class="mb-6 shadow-md rounded-lg bg-slate-50 w-full sm:w-[17rem] sm:mb-0 xl:mb-6 xl:w-full" width="1216" height="640">
            </li>
            @endforeach
        </ul>
        @else

        <p class="text-center font-semibold">No posts available at the moment.</p>

    @endif
</div>

@endsection