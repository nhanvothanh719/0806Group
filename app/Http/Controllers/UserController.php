<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\PhoneChangeRequest;
use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        //Get user's role
        $user_role = DB::table('roles')->select('name')->where('id', $user->id)->value('name');
        return view('user.index', compact('user', 'user_role'));
    }

    /**
     * Show the change password form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
        return view('user.changepassword');
    }

    public function updatePassword(PasswordChangeRequest $request)
    {
        $user = Auth::user();
        //If two passwords are the same
        //Hash::check --> Check whether the old password entered by user is correct or not
        if(!(Hash::check($request['old-password'], $user->password))) {
            return redirect()->back()->with(['class' => 'danger', 'message' => 'The password currently used does not matches with the provided password.']);
        }       
        //Sring compare: Old password and the new one
        if(strcmp($request['old-password'], $request['new-password']) == 0){
            return redirect()->back()->with(['class' => 'danger', 'message' => 'The new password cannot be the same with current password.']);
        }
        //bcrypt --> password-hashing function
        $user->password = bcrypt($request['new-password']);
        DB::table('users')->where('id', $user->id)->update(['password' => $user->password]);
        return redirect()->back()->with(['class' => 'success', 'message' => 'Password changed successfully !']);
    }

    public function changePhoneNumber(PhoneChangeRequest $request)
    {
        $user = Auth::user();
        $phoneNumber = $request['new-phone-number'];
        $user->phone_number = $phoneNumber;
        DB::table('users')->where('id', $user->id)->update(['phone_number' => $user->phone_number]);
        return redirect()->back()->with(['class' => 'success', 'message' => 'The phone number is updated!']);
    }

    public function uploadAvatar(Request $request)
    {
        $user = Auth::user();
        $pre_avatar_name = $user->avatar;
        //Delete previous avatar
        $directory = 'public/images/' . $pre_avatar_name;
        Storage::delete($directory);
        if($request->hasFile('image')){
            $imgName = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$imgName,'public');
            DB::table('users')->where('id', $user->id)->update(['avatar' => $imgName]);
        }
        return redirect()->back()->with(['class' => 'success', 'message' => 'Avatar is changed successfully!']);
    }
}
