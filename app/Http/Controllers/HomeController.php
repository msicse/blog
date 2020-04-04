<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use App\Post;
use App\Category;

use Toastr;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {

        $posts = Post::apporved()->published()->latest()->take(9)->get();
        $categories = Category::all();

        return view('welcome')->with(compact('posts','categories'));
    }

    public function subscribe(Request $request)
    {
        //return $request->all();
        $this->validate($request,array(
            'email' => 'required|email|unique:subscribers'
        ));

        $subscribe = new Subscriber;
        $subscribe->email = $request->input('email');
        $subscribe->save();

        Toastr::success('Succesfully Subscribed ', 'Success');

        return redirect()->back();
    }
}
