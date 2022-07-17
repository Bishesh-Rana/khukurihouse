<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryServiceArea;
class DeliveryServiceAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliver_setting = DeliveryServiceArea::paginate(10);
        return view('admin.list.delivery_service_area',compact('deliver_setting'));

    }

    public function allDelieverServiceAreaFetch(Request $request)
    {
        $area_name = $request->area_name;
        $rate = $request->rate;

        $deliver_setting = DeliveryServiceArea::when($area_name, function ($query, $area_name) {
            return $query->where("area_name", "LIKE", "%$area_name%");
        })
            ->when($rate, function ($query, $rate) {
                return $query->where("rate", "LIKE", "%$rate%");
            })
            ->paginate(10);
        return view('admin.list.ajaxlist.delivery_service_area', compact('deliver_setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = \DB::table('districts')->get();
        $selected = [];
        return view('admin.form.delivery_service_area',compact('districts','selected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'area_name' => 'required',
            'districts' => 'required',
            'rate' => 'required',
            'description' => 'nullable'
        ]);
        $data = [
            'area_name' => request('area_name'),
            'rate' => request('rate'),
            'description' => request('description'),
        ];

        $deliver_setting = DeliveryServiceArea::create($data);

        $deliver_setting->districts()->sync($request->districts);
        return redirect()->route('deliveryServiceArea.index')->with('success', 'Deliever Information Successfully Set !!!');
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
        $districts = \DB::table('districts')->get();
        $deliver_setting = DeliveryServiceArea::find($id);
        $selected = $deliver_setting->districts
        ->pluck('dist_id')
        ->flatten()
        ->all();
        return view('admin.form.delivery_service_area',compact('districts','deliver_setting','selected'));
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
        $this->validate(request(), [
            'area_name' => 'required',
            'districts' => 'required',
            'rate' => 'required',
            'description' => 'nullable'
        ]);
        $data = [
            'area_name' => request('area_name'),
            'rate' => request('rate'),
            'description' => request('description'),
        ];

        $deliver_setting = DeliveryServiceArea::find($id);
        $deliver_setting->update($data);
        $deliver_setting->districts()->sync($request->districts);

        return redirect()->route('deliveryServiceArea.index')->with('success', 'Deliever Information Successfully Updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
