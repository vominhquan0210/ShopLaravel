<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function brand()
    {
        $brand = DB::table('brands')->get();

        return view('Admin.Category-Brand.Brand',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Category-Brand.CreateBrand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();


        if(Brand::create($data)){
              return redirect()->back()->with('success',__('Create brand successfully'));
        } else {
              return redirect()->back()->withErrors('Error create brand');
        }


    }

    /**
     * Display the specified resource.
     */
    public function deleteBrand(string $id)
    {
        DB::table('brands')->where('id', $id)->delete();

        return redirect()->back()->with('success',__('Delete brand successfully'));

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
}
