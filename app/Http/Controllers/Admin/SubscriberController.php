<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;

use Toastr;
class SubscriberController extends Controller
{
    public function index()
    {
    	$subscribers = Subscriber::all();
    	return view('backend.admin.subcriber')->with(compact("subscribers"));
    }

    public function destroy($id)
    {
    	$subscriber = Subscriber::find($id);
    	$subscriber->delete();

    	Toastr::success('Subscriber Succesfully  Deleted', 'Success');

        return redirect()->back();

    }
}
