<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliverySetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DelieverSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $deliver_settings = DeliverySetting::paginate(10);
        return view('admin.list.deliever_setting', compact('deliver_settings'));
    }

    public function allDelieverSettingFetch(Request $request)
    {
        $destination = $request->destination;
        $rate = $request->rate;
        $minWeight = $request->minWeight;
        $maxWeight = $request->maxWeight;

        $deliver_settings = DeliverySetting::when($destination, function ($query, $destination) {
            return $query->where("destination", "LIKE", "%$destination%");
        })
            ->when($rate, function ($query, $rate) {
                return $query->where("rate", "LIKE", "%$rate%");
            })

            ->when($minWeight, function ($query, $minWeight) {
                return $query->where("weight_min", "LIKE", "%$minWeight%");
            })

            ->when($maxWeight, function ($query, $maxWeight) {
                return $query->where("weight_max", "LIKE", "%$maxWeight%");
            })
            ->paginate(10);
        return view('admin.list.ajaxlist.deliever_setting_list', compact('deliver_settings'));
    }

    public function create()
    {

        return view('admin.form.deliever_setting');
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'weight_min' => 'required',
            'weight_max' => 'required',
            'rate' => 'required',
            'destination' => 'required'

        ]);

        $deliver_setting =  new DeliverySetting();

        $deliver_setting->source = "kathmandu";
        $deliver_setting->weight_min = request('weight_min');
        $deliver_setting->weight_max = request('weight_max');
        $deliver_setting->rate = request('rate');
        $deliver_setting->destination = request('destination');
        $deliver_setting->save();

        return redirect()->route('admin.deliever_setting.list')->with('success', 'Deliever Information Successfully Set !!!');
    }

    public function edit($id)
    {
        $deliver_setting = DeliverySetting::where('id', $id)->firstOrfail();
        return view('admin.form.deliever_setting', compact('deliver_setting'));
    }

    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'weight_min' => 'required',
            'weight_max' => 'required',
            'rate' => 'required',
            'destination' => 'required'

        ]);

        $data = ([
            'weight_min' => request('weight_min'),
            'weight_max' => request('weight_max'),
            'rate' => request('rate'),
            'destination' => request('destination'),

        ]);

        DeliverySetting::where('id', $id)->update($data);
        return redirect()->route('admin.deliever_setting.list')->with('success', 'Deliever Information Successfully Updated !!!');
    }
}
