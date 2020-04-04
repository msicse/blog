<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;
use App\Subscriber;
use App\Notifications\ApprovedPost;
use App\Notifications\NewPostCreated;

use Carbon\Carbon;

use Auth;
use Toastr;
use Storage;
use Image;
use Notification;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        $posts = Post::apporved()->latest()->get();
        
        return view('backend.admin.post.posts')->withPosts($posts);
    }

    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('backend.admin.post.index')->withPosts($posts);
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
        return view('backend.admin.post.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return dd($request);
        $this->validate($request,array(
            'title' => 'required',
            'tags' => 'required',
            'categories' => 'required',
            'body' => 'required',
           'image' => 'required|mimes:jpg,jpeg,bmp,png,gif',
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

        $post->is_approved = true;

        $post->save();

        return $post;

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {

            Notification::route('mail', $subscriber->email)
            ->notify(new NewPostCreated($post));
        }
        
        Toastr::success('Post Succesfully Added ', 'Success');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.admin.post.show')->withPost($post);
    }

    public function pending()
    {
        $posts = Post::where('is_approved',false)->get();

        return view('backend.admin.pending-post')->withPosts($posts);

    }

    public function apporved($id)
    {
        $post = Post::find($id);

        $post->is_approved = true;
        $post->save();

        $user = $post->user;
        $subscribers = Subscriber::all();

        Notification::send($user, new ApprovedPost($post));

        foreach ($subscribers as $subscriber) {

            Notification::route('mail', $subscriber->email)
            ->notify(new NewPostCreated($post));
        }

        Toastr::success('Post Succesfully Approved ', 'Success');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Category::all();
        return view('backend.admin.post.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //return $request;
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

            if (Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }

        } else {
            $imagename = $post->image;
        }

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

        $post->is_approved = true;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        
        Toastr::success('Post Succesfully Updated ', 'Success');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
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
