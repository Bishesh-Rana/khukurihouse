<?php

namespace App\Http\Controllers\Admin;

use App\Models\PushNotification;
use App\Http\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PushNotificationController extends Controller
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
        $this->imageUpload($request, $files, 'pushnotification', 'pushnotifications', $formImage);
    }


    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'pushnotifications/' . $image);
        }
        $pushnotifications = PushNotification::orderBy('id', 'asc')->where('delete_status', '0')->paginate(10);
        return view('admin.list.pushnotification', compact('pushnotifications'));
    }

    public function fetch(Request $request)
    {
        $pushnotificationName = $request->pushnotificationName;

        $pushnotifications = PushNotification::orderBy('id', 'asc')
                ->where('delete_status', '0')
                ->when($pushnotificationName, function ($query, $pushnotificationName) {
                    return $query->where("title","LIKE","%$pushnotificationName%");
                })
                ->paginate(10);
        return view('admin.list.ajaxlist.pushnotification', compact('pushnotifications'));
    }

    public function create()
    {
        return view('admin.form.pushnotification');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,svg,png,gif|max:2048'
        ]);

        $pushnotification =  new PushNotification();

        $pushnotification->title = request('title');
        $pushnotification->description = request('description');
        $pushnotification->external_url = request('external_url');
        $pushnotification->slug =  request('slug');
        $pushnotification->type =  request('type');

        $pushnotification->image = $request->session()->get('ajaximage');

        $pushnotification->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/pushnotifications')->with('success', 'PushNotification added successsfully');
    }

    public function edit($id)
    {
        $pushnotification = PushNotification::where('id', $id)->first();
        return view('admin.form.pushnotification', compact('pushnotification'));
    }

    public function update(Request $request, $id)
    {
        $pushnotification = PushNotification::where('id', $id)->first();

        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,jpg,svg,png,gif|max:2048'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $pushnotification->image;
            @unlink('uploads/' . 'pushnotifications/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            PushNotification::where('id', $id)->update($data1);
        }

        $data = ([
            'title' => request('title'),
            'description' => request('description'),
            'external_url' => request('external_url'),
            'type' => request('type'),
            'slug' => request('slug')
        ]);

        PushNotification::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/pushnotifications')->with('success', 'PushNotification updated successfully');
    }

    public function destroy($id)
    {
        $pushnotification = PushNotification::where('id', $id)->first();

        if (isset($pushnotification)) {

            $data = ([
                'delete_status' => '1',
            ]);

            PushNotification::where('id', $id)->update($data);

            return redirect('/ns-admin/pushnotifications')->with('success', 'PushNotification deleted successfully.');
        }
        return redirect('/ns-admin/pushnotifications')->with('error', 'PushNotification deletion failed.');
    }

    public function send($id)
    {
        $pushnotification = PushNotification::where('id', $id)->first();
        dd($pushnotification);
        // var_dump($type,$user_id,$title,$description);exit();
        $curl = curl_init();
           curl_setopt_array($curl, array(
               CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => '{
                                            "to":"/topics/all",
                                            "data":{
                                                "title":"'.$pushnotification->title.'",
                                                "type" :"'.$pushnotification->type.'",
                                                "message":"'.$pushnotification->description.'"
                                                "slug":"'.$pushnotification->slug.'"
                                                "image":"'.asset('uploads/pushnotifications/'.$pushnotification->image).'"
                                            },
                                            "android":{
                                                "notification":{
                                                    "sound":"default"
                                                }
                                            }
                                        }',
               CURLOPT_HTTPHEADER => array(
                   "Authorization: key=AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu",
                   "Content-Type: application/json",
                   "Postman-Token: ef8f2298-8743-4576-9a66-5065f361124f",
                   "cache-control: no-cache"
               ),
           ));
           $response = curl_exec($curl);
           $err = curl_error($curl);
           curl_close($curl);
        //   echo $response;
        if(isset($response))
        {
            return redirect('/ns-admin/pushnotifications')->with('success', 'Notification send successfully.');
        }else
        {
            return redirect('/ns-admin/pushnotifications')->with('success', 'Notification send fail.');
        }
    }
}
