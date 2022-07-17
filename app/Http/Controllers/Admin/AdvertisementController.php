<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Mail\MailToSubcriber;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class AdvertisementController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'notice', 'notices', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/notices/' . $image);
        }
        $advertisements = Advertisement::orderBy('id','asc')->where('delete_status','0')->get();
        return view('admin.list.advertisement',compact('advertisements'));
    }

    public function create()
    {
        return view('admin.form.advertisement');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,svg,png,gif|max:2048'
        ]);

        $advertisement =  new Advertisement();

        $advertisement->title = request('title');
        $advertisement->body = request('body');
        $advertisement->link = request('link');
        $advertisement->placement = request('placement');
        $advertisement->featured = request('featured');
        $advertisement->publish_status =  request('publish_status');

        $advertisement->image = $request->session()->get('ajaximage');

        $advertisement->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/advertisements')->with('success', 'Advertisement added successsfully');

    }

    public function edit($id)
    {
        $advertisement = Advertisement::where('id',$id)->first();
        return view('admin.form.advertisement',compact('advertisement'));
    }

    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::where('id', $id)->first();

        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,jpg,svg,png,gif|max:2048'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $advertisement->image;
            @unlink('uploads/notices/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            Advertisement::where('id', $id)->update($data1);
        }

        $data = ([
            'title' => request('title'),
            'body' => request('body'),
            'link' => request('link'),
            'placement' => request('placement'),
            'featured' => request('featured'),
            'publish_status' => request('publish_status')
        ]);

        Advertisement::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/advertisements')->with('success', 'Advertisement updated successfully');
    }

    public function destroy($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();

        if(isset($advertisement))
        {
            $data = ([
                'delete_status' => '1',
            ]);

            Advertisement::where('id', $id)->update($data);
            return redirect('/ns-admin/advertisements')->with('success','Advertisement deleted successfully.');
        }
        return redirect('/ns-admin/advertisements')->with('error','Advertisement delete failed.');
    }

    public function removeImage($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();

        if(isset($advertisement))
        {
            //removing  image from folder
            $image = $advertisement->image;
            @unlink('uploads/notices/'.$image);

            //removing image from data base
            $data2 = (['image' => null]);
            Advertisement::where('id', $id)->update($data2);
            return back()->with('success','Photo deletion Success.');
        }
        return back()->with('error','Photo deletion failed.');
    }

    public function mailtosubscribers($ad){
        $advertisement = Advertisement::where('id', $ad)->first();
        $subscribers = Subscriber::where('delete_status', '0')->get();

        foreach($subscribers as $subscriber){
            $img_url = env('APP_URL').'/uploads/notices/'.$advertisement->image;
            // dd($img_url);
            $email  = $subscriber->subscriber_email;
            $advertisement_message = "Here I'm";

            $data = [
                'img_url' => $img_url,
                'advertisement_message'=>$advertisement_message,
                'url'=>$advertisement->link,
            ];

            Mail::to($email)->send(new MailToSubcriber($data));
        }

        return redirect()->back()->with('success', 'Successfully Mailed');
    }
}
