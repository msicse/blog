<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use App\User;

use Auth;
use Toastr;
use Storage;
use Image;

class SettingsController extends Controller
{
    public function index()
    {
    	return view('backend.admin.setting.index');
    }

    public function profileUpdate(Request $request)
    {
    	
    	$this->validate($request,array(
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
            'avater' => 'mimes:jpg,jpeg,bmp,png,gif',
        ));
    	//return $request;
        $user = User::findOrFail(Auth::id());

        $image = $request->file('avater');
        $slug  = str_slug($request->input('name'));
        if (isset($image)){
            if (!Storage::disk('public')->exists('user')){
                Storage::disk('public')->makeDirectory('user');
            }
            $date = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $postImage = Image::make($image)->resize(500, 500)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('user/'.$imagename, $postImage);

        } else {
            $imagename = 'no-image.png';
        }

        $user->name 	= $request->input('name');
        $user->email 	= $request->input('email');
        $user->about 	= $request->input('about');
        $user->image 	= $imagename;
        $user->save();

        Toastr::success('Profile Succesfully Updated ', 'Success');
        return redirect()->back();
    }
    public function passwordUpdate(Request $request)
    {
    	
    	$this->validate($request,array(
            'current' 				 => 'required|min:6',
            'password' 				 => 'required|min:6|confirmed',
            'password_confirmation ' => 'min:6',
        ));

        $password = $request->input('current');

        $user = User::find(Auth::id());

    	if (Hash::check($password, $user->password)) {

	        $user->password = Hash::make($request->input('password'));
	        $user->save();

	        Toastr::success('Password Succesfully Updated ', 'Success');
        	return redirect()->back();
    	} else {
    		Toastr::error("Current password dose not Match","Error",["positionClass" => "toast-top-right"]);
    		
    		return redirect()->back();
    	}
    }
}
