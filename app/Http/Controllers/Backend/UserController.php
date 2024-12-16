<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        // dd($users);
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        // if ($request->allFiles('image')) {     
        //     $fileName = $request->file('image')->hashName();
        //     $path = $request->file('image')->storeAs('images', $fileName, 'public');
        //     $user["image"] = '/storage/'.$path;
        // }

        // dd($request->all());
        $user->save();

        return redirect('/admin/users');
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
        $user = User::where('id', $id)->first();
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::find($id); // Find the user to update
        $user->name = $request->input('name');
        $user->email = $request->input('email'); // Only update email if it's different

        
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
               

        // dd($user);
        $user->save();
        return redirect('/admin/users/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect('/admin/users');
    }
}
