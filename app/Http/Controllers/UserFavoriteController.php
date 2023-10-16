<?php

namespace App\Http\Controllers;

use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFavoriteController extends Controller
{
    public function store(string $id) {
        UserFavorite::create([
            'user_id' => Auth::user()->id,
            'exhibition_id' => $id
        ]);

        return redirect()->back()->with('message', 'Added to favorite!');
    }
}
