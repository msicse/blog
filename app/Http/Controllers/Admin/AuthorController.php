<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class AuthorController extends Controller
{
    public function index()
    {
    	$author = User::author()->get();

    	return view('backend.admin.author')->withAuthor($author);
    }
}
