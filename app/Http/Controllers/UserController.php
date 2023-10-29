<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $roles->pop();

        return view('auth.register', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Srediti validaciju
        $input = $request->validate([
            'name' => 'required|min:5',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'min:6',
            'role_id' => 'required'
        ]);


        $input['password'] = bcrypt($input['password']);
        
        $user = User::create($input);
        auth()->login($user);

        $request->session()->regenerate();

        return redirect('/')->with('message', 'You are registered!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->get()->first();

        // foreach ($user->favorites as $favorite) {
        //     $imageUrl = asset('/images/'. $favorite->art->image);

        //     $encodedImageUrl = rawurldecode($imageUrl);
        // }

        // $shareComponent = \Share::page(
        //     $encodedImageUrl,
        //     'Your share text comes here',
        // )
        // ->facebook();
        
        return view('profile', compact('user'));
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

    public function login(Request $request) {
        $input = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($input)) {
            if (User::where('email', $input['email'])->get()->first()->is_blocked) {
                auth()->logout();
                return back()->with('error', 'You are blocked!');
            }

            $request->session()->regenerate();
            if (auth()->user()->role->role_name == 'admin') {
                return redirect('/admin')->with('message', 'You are logged in!');
            } else {
                return redirect('/')->with('message', 'You are logged in!');
            }
        } else {
            return back()->with('error', 'Email or password is not correct!');
        }
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You are logged out successfully!');
    }

    public function profile_image(Request $request) {
        $request->validate([
            'profile_image' => 'required|image'
        ]);

        $image = $request->file('profile_image');
        $imageName = $request->file('profile_image')->getClientOriginalName();
        
        $image->move(public_path(). '/images/', $imageName);

        User::whereId(auth()->user()->id)->update([
            'profile_image' => $imageName
        ]);

        return back();
    }
}
