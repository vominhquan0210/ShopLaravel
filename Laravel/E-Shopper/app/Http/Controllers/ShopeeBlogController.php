<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopeeBlogRequest;
use App\Models\ShopeeBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopeeBlogController extends Controller
{
    public function index()
    {
        $blog = DB::table('shopee_blogs')->get();
        return view('Admin.Blog.Blog', compact('blog'));
    }

    public function create()
    {

        return view('Admin.Blog.CreateBlog');
    }

    public function store(ShopeeBlogRequest $request)
    {
        $data = $request->all();

        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if (ShopeeBlog::create($data)) {

            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect('shopee-blog')->with('success', __('Create blog success.'));
        }
    }


    public function editShopeeBlog($id)
    {
        $blog = DB::table('shopee_blogs')->find($id);


        return view('Admin.Blog.EditBlog', compact('blog'));
    }


    public function updateShopeeBlog(ShopeeBlogRequest $request, $id)
    {

        $data = $request->all();
        $idBlog = ShopeeBlog::find($id);
        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($idBlog->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect('/shopee-blog')->with('success', __('Update blog success.'));
        }
    }


    public function deleteShopeeBlog(string $id){

        // DB::table('shopee_blogs')->where('id', $id)->delete();

        ShopeeBlog::where('id',$id)->delete();

       return redirect('/shopee-blog')->with('success', 'Blog đã được xóa!');

    }
}
