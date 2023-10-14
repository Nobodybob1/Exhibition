<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, string $id) {
        $user_id = Auth::user()->id;
        $art_id = Exhibition::whereId($id)->get()->first()->id;
        
        Rating::create([
            'user_id' => $user_id,
            'exhibition_id' => $art_id,
            'rating' => $request->rating
        ]);

        return back();
    }
}
