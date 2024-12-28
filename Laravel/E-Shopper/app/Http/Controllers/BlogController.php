<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rate;
use App\Models\ShopeeBlog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BlogController extends Controller
{




    public function blogDetail( $id)
    {
        $blogDetail = DB::table('shopee_blogs')->find($id);

        $nextButton = DB::table('shopee_blogs')->where('id','>', $id)->orderBy('id','asc')->first();

        $preButton = DB::table('shopee_blogs')->where('id','<',$id)->orderBy('id','desc')->first();

        $user = Auth::id();

        $rating  = Rate::where('id_blog',$id)->get();

        $total = 0;

        $count = $rating->count();

        foreach($rating as $rating){
           $total += $rating->rate;
        }

        if($count > 0){
           $average = round($total/$count);
        } else {
           $average = 0;
        }

        $listComment = DB::table('comments')->where('id_blog', $id)->get();




        return view('Frontend.Blog.BlogDetail',['showSidebar' => true],compact('blogDetail' , 'nextButton' , 'preButton' , 'user', 'average', 'count' , 'listComment'));

    }

    public function blog()
    {
        $blogs = ShopeeBlog::paginate(3);
        return view('Frontend.Blog.Blog',['showSidebar' => true], compact('blogs'));
    }


    public function ratingAjax(Request $request)
    {


       DB::table('rates')->insert([
        [
            'rate' => $request->rate,
            'id_blog' =>$request->id_blog,
            'id_user' =>$request->id_user,
        ]
        ]);





    return response()->json([
        'success' => 'Rating submitted successfully',

    ]);
    }

    public function comment(Request $request, $id)
    {

        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $parentId = $request->parent_id ?? 0;

        DB::table('comments')->insert([
            [
                'cmt' => $request->cmt,
                'id_user' => Auth::id(),
                'id_blog' => $id,
                'avatar_user' => $user->avatar,
                'name_user' => $user->name,
                'level' =>$parentId,
                'created_at'=>now(),
                'updated_at'=>now()
            ]
            ]);

            return redirect()->back()->with('success', __('Upload profile thành công.'));
    }


   public function commentAjax(Request $request, $id)
{
    $userId = Auth::id();
    $user = User::find($userId);
    $parentId = $request->parentId ?? 0;

    $newComment = Comment::create([
        'cmt' => $request->cmt,
        'id_user' => $request->idUser,
        'id_blog' => $request->idBlog,
        'level' => $parentId,
        'avatar_user' => $user->avatar,
        'name_user' => $user->name,
    ]);


    return response()->json([
        'success' => true,
        'data' => $newComment,
    ]);
}
    public function listAjax($id){
        $data =DB::table('comments')->where('id_blog',$id)->get();

        return response()->json([
            'data' => $data
        ]);
    }



}
