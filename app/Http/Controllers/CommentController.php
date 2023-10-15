<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, String $id) {
        $input = $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'exhibition_id' => $id,
            'comment' => $input['comment']
        ]);

        return redirect()->back();
    }
}
