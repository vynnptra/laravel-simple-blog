<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\DetailBlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestBlog = Blog::latest()->first();
    
        // Bersihkan tag media dari latest blog
        if ($latestBlog) {
            $latestBlog->content = preg_replace('/<img[^>]*>|<iframe[^>]*>.*?<\/iframe>|<video[^>]*>.*?<\/video>/i', '', $latestBlog->content);
        }
    
        // Ambil semua blog dan bersihkan tag media satu-satu
        $blogs = Blog::all()->map(function ($item) {
            $item->content = preg_replace('/<img[^>]*>|<iframe[^>]*>.*?<\/iframe>|<video[^>]*>.*?<\/video>/i', '', $item->content);
            return $item;
        });
    
        $newBlogs = Blog::latest()->skip(1)->take(5)->get();
    
        return view('blogs.index', [
            'blogs' => $blogs,
            'latestBlog' => $latestBlog,
            'newBlogs' => $newBlogs
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string',
            'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('feature_image')->store('blogs', 'public');

        
        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'feature_image' => $imagePath,
        ]);
 // Simpan detail images (jika ada)
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $path = $image->store('blog/detail_images', 'public');
                DetailBlogImage::create([
                    'blog_id' => $blog->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     */public function show(Blog $blog)
        {
            return view('blogs.detail', [
                'blog' => $blog
            ]);
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string',
            'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        
        
        
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        
        if ($request->hasFile('feature_image')) {
            // Delete old image file from storage (optional but recommended)
            if ($blog->feature_image && Storage::disk('public')->exists($blog->feature_image)) {
                Storage::disk('public')->delete($blog->feature_image);
            }
        
            // Store new image
            $imagePath = $request->file('feature_image')->store('blogs', 'public');
        
            // Update the blog with new feature image path
            $blog->update([
                'feature_image' => $imagePath
            ]);
        }
        
        

        DetailBlogImage::where('blog_id', $blog->id)->delete();

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $path = $image->store('blog/detail_images', 'public');
                DetailBlogImage::create([
                    'blog_id' => $blog->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('blog.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index');
    }
}
