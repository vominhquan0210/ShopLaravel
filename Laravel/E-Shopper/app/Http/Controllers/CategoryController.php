<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category(){
        $category = DB::table('categories')->get();
        return view('Admin.Category-Brand.Category',compact('category'));
    }

    public function create(){

        return view('Admin.Category-Brand.CreateCategory');
    }

    public function store(Request $request){

        $data = $request->all();

        if(Category::create($data)){
            return redirect()->back()->with('success' , __('Create category success'));
        } else {
            return redirect()->back()->withErrors('Create category error.');

        }
    }

    public function delete($id){

        DB::table('categories')->where('id',$id)->delete();

        return redirect()->back()->with('success' , __('Delete category success'));

    }
}
