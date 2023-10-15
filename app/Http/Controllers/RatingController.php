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
        
        Rating::create([
            'user_id' => $user_id,
            'exhibition_id' => $id,
            'rating' => $request->rating
        ]);

        return back();
    }

    public function update(Request $request, string $id) {
        Auth::user()->ratings()->where('exhibition_id', $id)->update([
            'rating' => $request['rating']
        ]);

        return redirect()->back();
    }
}
