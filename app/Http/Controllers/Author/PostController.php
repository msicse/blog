<?php

namespace App\Http\Controllers\Author;


use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;

use App\Notifications\NewAuthorPost;
use Notification;
use App\User;
use App\Post;
use App\Category;
use App\Tag;
use Auth;
use Toastr;
use Storage;
use Carbon\Carbon;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('backend.author.post.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('backend.author.post.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'title' => 'required',
            'tags' => 'required',
            'categories' => 'required',
            'body' => 'required',
           'image' => 'mimes:jpg,jpeg,bmp,png,gif',
        ));
        $image = $request->file('image');
        $slug  = str_slug($request->input('title'));
        if (isset($image)){
            if (!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            $date = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $postImage = Image::make($image)->resize(1600, 1066)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('post/'.$imagename, $postImage);

        } else {
            $imagename = 'default.png';
        }

        $checkSlug = Post::where('slug',$slug)->exists();
        
        if ($checkSlug) {
            $slug = $slug . '-' . rand(5, 100);
        }


        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->image = $imagename;
        $post->body = $request->input('body');

        if (isset($request->publish)) {
            $post->status = true;
        }else {
            $post->status = false;
        }


        $post->is_approved = false;

        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id',1)->get();

        Notification::send($users, new NewAuthorPost($post));
        
        Toastr::success('Post Succesfully Added ', 'Success');
        return redirect()->route('author.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.author.post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        if (Auth::user()->id != $post->user_id) {
            Toastr::warning('You have no permission to edit this post', 'Warning');
            return redirect()->route('author.posts.index'); 
        }

        $tags = Tag::all();
        $categories = Category::all();
        return view('backend.author.post.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,array(
            'title' => 'required',
            'tags' => 'required',
            'categories' => 'required',
            'body' => 'required',
            'image' => 'mimes:jpg,jpeg,bmp,png,gif',
        ));
        //$post = Post::find($id);

        if (Auth::user()->id != $post->user_id) {
            Toastr::warning('You have no permission to edit this post', 'Warning');
            return redirect()->route('author.posts.index'); 
        }

        $image = $request->file('image');
        $slug  = str_slug($request->input('title'));
        if (isset($image)){
            if (!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            $date = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $postImage = Image::make($image)->resize(1600, 1066)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('post/'.$imagename, $postImage);

            if (Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }

        } else {
            $imagename = $post->image;
        }


       // $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->image = $imagename;
        $post->body = $request->input('body');

        if (isset($request->publish)) {
            $post->status = true;
        }else {
            $post->status = false;
        }


        $post->is_approved = false;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        
        Toastr::success('Post Succesfully Updated ', 'Success');
        return redirect()->route('author.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
        if (Auth::user()->id != $post->user_id) {
            Toastr::warning('You have no permission to edit this post', 'Warning');
            return redirect()->route('author.posts.index'); 
        }

        if (Storage::disk('public')->exists('post/'.$post->image)){
            
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        
        $post->delete();

        Toastr::success('Post Succesfully Deleted ', 'Success');
        return redirect()->back();
    }
}
