<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile($id)

    {
        $country = Country::get();
        $user = DB::table('users')->where('id', $id)->first();


        return view('Frontend.Profile.Profile', compact('user', 'country'));
    }


    public function update(UpdateProfileRequest $request, string $id)
    {
        $idUser = Auth::id();

        $user =  User::find($idUser);

        $data = $request->all();

        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        if($user->update($data)){

            if(!empty($file)){
                $file->move('/upload/user/avatar', $file->getClientOriginalName());
            }

            return redirect()->back()->with('success' , __('Update profile success'));
        }
        else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

}
