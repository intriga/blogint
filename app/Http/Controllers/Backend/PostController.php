<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->get();
        // dd($posts);
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        // dd($categories);
        return view('backend.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category');
        $post->user_id = Auth::id(); // Associate the post with the currently authenticated user

        if ($request->allFiles('image')) {     
            $fileName = $request->file('image')->hashName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $post["image"] = '/storage/'.$path;
        }

        // dd($request->all());
        $post->save();

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::where('id', $id)->first();
        $categories = Category::get();
        // dd($categories);
        return view('backend.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->content = $request->input('content');  
        
        $old_image = $post->old_image = $request->input('old_image');

        $image = $request->file('image'); // Access uploaded file
        // dd($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            // Delete the old image if it exists
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
    
            $fileName = $image->hashName();
            $imagePath = '/images/' . $fileName;
            $image->move(public_path('images'), $fileName);
    
            $post->image = $imagePath;
        }

        //dd($post);
        $post->save();
        return redirect('/admin/posts/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        //$post->delete();
        if ($post->image) {
            $imagePath = public_path($post->image); // Get the absolute path to the image
    
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Delete the file using Laravel's File facade
            }
    
            $post->delete();
        } else {
            $post->delete();
        }
        return redirect('/admin/posts');
    }
}
