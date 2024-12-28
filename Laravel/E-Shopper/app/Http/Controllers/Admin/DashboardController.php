<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth');
     }


    public function index()
    {
        return view('Admin.Dashboard.Dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showCountry()
    {
        $country = DB::table('countries')->get();


        return view('Admin.Country.country',compact('country'));
    }

    public function editCountry()
    {
       return view('Admin.Country.create-country');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCountry(Request $request)
    {
        $user = DB::table('countries')->insert([
            [
                'name' => $request->name,
            ]
            ]);

         return redirect('/country');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function deleteCountry(string $id)
    {
       DB::table('countries')->where('id',$id)->delete();
       return redirect('/country')->with('success', 'Quốc tịch đã được xóa!');

    }
}
