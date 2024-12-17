<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        // dd($categories);
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the user is an admin
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            throw new HttpException(403, 'You do not have permission to access this resource.');
        }
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');

        // dd($request->all());
        $category->save();

        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Check if the user is an admin
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            throw new HttpException(403, 'You do not have permission to access this resource.');
        }
        $category = Category::where('id', $id)->first();
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Check if the user is an admin
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            throw new HttpException(403, 'You do not have permission to access this resource.');
        }

        $category = Category::find($id);

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');       
        

        //dd($category);
        $category->save();
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if the user is an admin
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            throw new HttpException(403, 'You do not have permission to access this resource.');
        }

        $category = Category::find($id);
        $category->delete();
        
        return redirect('/admin/categories');
    }
}
