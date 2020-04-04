<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Toastr;

class FavoriteController extends Controller
{
    function index()
    {
    	
    }

    function add($post)
    {
    	
    	$user = Auth::user();

    	$isFavorite = $user->favorite_posts()->where('post_id',$post)->count();

    	if ( $isFavorite == 0 ) {

    		$user->favorite_posts()->attach($post);

    		Toastr::success('The post is added to Favorite list ', 'Success');

        	return redirect()->back();
    	}else {
    		$user->favorite_posts()->detach($post);

    		Toastr::success('The post is removed from Favorite list ', 'Success');

        	return redirect()->back();
    	}
    	
    }
}
