<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $arts = Exhibition::latest()->get();
        $search = collect();

        if ($request['search']) {
            $search = Exhibition::where('name', 'like', '%'. $request['search']. '%')->get();
        }

        return view('exhibitions', compact('arts', 'search'));
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
            'description' => 'required',
            'art_image' => 'required|image'
        ]);

        $image = $request->file('art_image');
        $imageName = $request->file('art_image')->getClientOriginalName();
        
        $image->move(public_path(). '/images/', $imageName);

        $art = Exhibition::create([
            'name' => $input['name'],
            'image'=>$imageName, 
            'user_id'=>auth()->user()->id,
            'description' => $input['description'], ]);


        return redirect('/profile/'. auth()->user()->id)->with('message', 'Art created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $art = Exhibition::where('id', $id)->get()->first();

        if (Auth::user()->id !== $art->user->id) {
            $viewCounter = Session::get('viewed_pages', []);
            if (!in_array($id, $viewCounter)) {
                $art->increment('views');
                Session::push('viewed_pages', $id);
            }
        }

        return view('exhibition_single', compact('art'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->exhibitions()->whereId($id)->exists()) {
            $art = Exhibition::where('id', $id)->get()->first();
            return view('exhibition_update', compact('art'));
        } else {
            return redirect()->back();
        }

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Exhibition::whereId($id)->update([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        return redirect('/profile/'. Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function search(Request $request) {
    //     $search = Exhibition::where('name', 'like', '%'. $request['search']. '%')->get();
        
    //     return view('exhibitions', compact('search'));
    // }
}
