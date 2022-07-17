<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $subscribers = Subscriber::orderBy('id','desc')->where('delete_status','0')->get();
        return view('admin.list.subscriber',compact('subscribers'));
    }

    public function delete($id)
    {
        $subscriber = Subscriber::where('id', $id)->first();
        $subscriber->delete_status = '1';
        $subscriber->save();

        return redirect('/ns-admin/subscribers')->with('success','Subscriber deleted successfully.');
    }
}
