<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_create_artist');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|min:5',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'min:6',
        ]);

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'role_id' => 2
        ]);

        return redirect('/admin_artists');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $artists = User::where('role_id', 2)->get();
        
        return view('admin_artists', compact('artists'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::whereId($id)->update([
            'is_blocked' => 1
        ]);

        return redirect()->back()->with('message', 'User has been blocked');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Exhibition::whereId($id)->delete();

        return redirect('/admin_arts');
    }

    public function arts() {
        $arts = Exhibition::all();

        return view('admin_arts', compact('arts'));
    }

    public function delete_comment(string $id) {
        Comment::whereId($id)->delete();

        return back();
    }
}
