<?php

namespace App\Http\Controllers\Delivery;

use App\Models\DeliveryDeliverySetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeliveryDeliverySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function index()
    {
        $deliver_settings = DeliveryDeliverySetting::where('delivery_id',Auth::guard('delivery')->user()->id)->paginate(10);
        return view('delivery.list.deliverysetting', compact('deliver_settings'));
    }

    public function fetch(Request $request)
    {
        $destination = $request->destination;
        $rate = $request->rate;
        $minWeight = $request->minWeight;
        $maxWeight = $request->maxWeight;

        $deliver_settings = DeliveryDeliverySetting::where('delivery_id',Auth::guard('delivery')->user()->id)
        ->when($destination, function ($query, $destination) {
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
        return view('delivery.list.deliversettingajax', compact('deliver_settings'));
    }

    public function create()
    {
        return view('delivery.form.deliverysetting');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'weight_min' => 'required',
            'weight_max' => 'required',
            'rate' => 'required',
            'destination' => 'required'
        ]);

        $deliver_setting =  new DeliveryDeliverySetting();

        $deliver_setting->delivery_id = Auth::guard('delivery')->user()->id;
        $deliver_setting->source = "Kathmandu";
        $deliver_setting->weight_min = request('weight_min');
        $deliver_setting->weight_max = request('weight_max');
        $deliver_setting->rate = request('rate');
        $deliver_setting->destination = request('destination');
        $deliver_setting->save();

        return redirect()->route('delivery.deliverysetting.list')->with('success', 'Deliever Information Successfully Set !!!');
    }

    public function edit($id)
    {
        $deliver_setting = DeliveryDeliverySetting::where('id', $id)->firstOrfail();
        return view('delivery.form.deliverysetting', compact('deliver_setting'));
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
            'delivery_id' => request('delivery_id'),
            'weight_min' => request('weight_min'),
            'weight_max' => request('weight_max'),
            'rate' => request('rate'),
            'destination' => request('destination'),
        ]);

        DeliveryDeliverySetting::where('id', $id)->update($data);
        return redirect()->route('delivery.deliverysetting.list')->with('success', 'Deliver setting updated successfully!');
    }
}
