<nav class="bg-white shadow fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between text-gray-600">
        <!-- Logo / Title -->
        <div class="text-xl font-semibold tracking-tight">
            Blogs
        </div>

        <!-- Search -->
        <div class="relative hidden lg:block w-full max-w-md">
            <input
                type="search"
                name="search"
                placeholder="Search"
                class="w-full border-2 border-gray-300 bg-white h-10 pl-4 pr-10 rounded-lg text-sm focus:outline-none"
            >
            <button type="submit" class="absolute top-1/2 -translate-y-1/2 right-3">
                <svg class="h-4 w-4 text-gray-600 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 56.966 56.966">
                    <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786
                        c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23
                        c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208
                        c0.571,0.593,1.339,0.92,2.162,0.92
                        c0.779,0,1.518-0.297,2.079-0.837
                        C56.255,54.982,56.293,53.08,55.146,51.887z
                        M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
                        s-17-7.626-17-17S14.61,6,23.984,6z"/>
                </svg>
            </button>
            
        </div>
        @if (Route::is('blog.index')) 
        <div>
            <a href="{{ route('blog.create') }}" class=" float-end p-2 bg-blue-500 rounded text-white font-semibold hover:bg-blue-600">Create New Post</a>
        </div>
        @else
        
        @endif
    </div>
</nav>
