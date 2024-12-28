<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function comment(Request $request, $id)
    {

        $userId = Auth::id();
        $user = User::findOrFail($userId);



        DB::table('comments')->insert([
            [
                'cmt' => $request->cmt,
                'id_user' => Auth::id(),
                'id_blog' => $id,
                'avatar_user' => $user->avatar,
                'name_user' => $user->name,
                'level' => 0,
                'created_at'=>now(),
                'updated_at'=>now()
            ]
            ]);

            return redirect()->back()->with('success', __('Upload profile thành công.'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listComment(string $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
