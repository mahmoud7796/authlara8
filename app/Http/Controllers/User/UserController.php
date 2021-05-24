<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Traits\General;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    use General;


    public function logout(){
        Auth::logout();
        return redirect()-> route('login');
    }

    public function profile(){
        $id = Auth::id();
        $user = User::find($id);
        return view('user.profile.profile_view',compact('user'));
    }

    public function edit(){
        $id = Auth::id();
        $user = User::find($id);
        return view('user.profile.profile_edit',compact('user'));
    }
    public function update(ProfileRequest $request){
      // return $request;
        $id = Auth::id();
        $user = User::find($id);
        $user -> name =$request -> name;
        $user -> email = $request -> email;
        $user -> save();
       // return $imageName = $this -> saveImage($request -> profile_image, 'upload/users_images/');

        if($request -> file('profile_image')){
            $imageName = $this -> saveImage($request -> profile_image, 'upload/users_images/');
            $user -> profile_photo_path = $imageName;
            $user -> save();
        }
        return redirect()-> route('user.profile')-> with(['success' => 'data updated successfully']);

    }
}
