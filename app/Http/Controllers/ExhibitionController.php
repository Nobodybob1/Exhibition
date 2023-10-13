<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('exhibitions');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        return view('exhibition_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required',
            'art_image' => 'required|image'
        ]);

        $image = $request->file('art_image');
        $imageName = $request->file('art_image')->getClientOriginalName();
        
        $image->move(public_path(). '/images/', $imageName);

        Exhibition::create([
            'name'=>$input['name'], 
            'image'=>$imageName, 
            'user_id'=>auth()->user()->id]);

        return redirect('/profile/'. auth()->user()->id);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}