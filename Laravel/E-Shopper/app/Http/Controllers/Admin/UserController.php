<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{








    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = User::findOrFail($id);
        // $user = DB::table('users')->where('id',$id)->first();
        $country = DB::table('countries')->get();


        $user = DB::table('users')
        ->join('countries', 'users.id_country', '=', 'countries.id')
        ->where('users.id', $id)
        ->select('users.*', 'countries.name as country_name')
        ->first();



    return view('Admin.Profile.Profile', compact('user', 'country'));

    }


    /**
     * Update the specified resource in storage.
     */
 public function update(UpdateProfileRequest $request)
        {
            $userId = Auth::id();
            $user = User::findOrFail($userId);



            $data = $request->all();
            $file = $request->avatar;
            if(!empty($file)){
                $data['avatar'] = $file->getClientOriginalName();
            }

            if ($data['password']) {
                $data['password'] = bcrypt($data['password']);
            }else{
                $data['password'] = $user->password;
            }

            if ($user->update($data)) {
                if(!empty($file)){
                    $file->move('upload/user/avatar', $file->getClientOriginalName());
                }
                return redirect()->back()->with('success', __('Update profile success.'));
            } else {
                return redirect()->back()->withErrors('Update profile error.');
            }

        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

