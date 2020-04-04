<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;
use Storage;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.category.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|max:255|unique:categories',
            'image' => 'required|mimes:jpg,jpeg,bmp,png,gif',
        ));
        $image = $request->file('image');
        $slug  = str_slug($request->input('name'));
        if (isset($image)){
            if (!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            $date = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $categoryImage = Image::make($image)->resize(500, 333)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('category/'.$imagename, $categoryImage);

            if (!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            $sliderImage = Image::make($image)->resize(1600, 691)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/'.$imagename, $sliderImage);
        } else {
            $imagename = 'default.png';
        }


        $category = new Category;
        $category->name = $request->input('name');
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Category Succesfully Added ', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category = Category::find($id);

        $this->validate($request,array(
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,jpeg,bmp,png,gif',

        ));

        $image = $request->file('image');
        $slug  = str_slug($request->input('name'));

        if (isset($image)){

            $date = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            if (Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
            }

            $categoryImage = Image::make($image)->resize(500, 333)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('category/'.$imagename, $categoryImage);

            if (!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }

            if (Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            $sliderImage = Image::make($image)->resize(1600, 691)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/'.$imagename, $sliderImage);
        } else {
            $imagename = $category->image;
        }



        $category->name = $request->input('name');
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Category Succesfully Updated ', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        if (Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }

        $category->delete();
        Toastr::success('Category Succesfully Deleted ', 'Success');
        return redirect()->back();
    }
}
