<?php

namespace App\Http\Controllers\Admin;

use App\Models\Measure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeasureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $measures = Measure::orderBy('id', 'asc')->where('delete_status', '0')->paginate(10);
        return view('admin.list.measure', compact('measures'));
    }

    public function create()
    {
        return view('admin.form.measure');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'measure_name' => 'required',
        ]);

        $measure =  new Measure();

        $measure->measure_name = request('measure_name');
        $measure->publish_status = request('publish_status');

        $measure->save();
        return redirect('/ns-admin/measures')->with('success', 'Measure added successsfully');
    }

    public function edit($id)
    {
        $measure = Measure::where('id', $id)->first();
        return view('admin.form.measure', compact('measure'));
    }

    public function update(Request $request, $id)
    {
        $measure = Measure::where('id', $id)->first();

        $this->validate(request(), [
            'measure_name' => 'required',
        ]);

        $data = ([
            'measure_name' => request('measure_name'),
            'publish_status' => request('publish_status'),
        ]);

        Measure::where('id', $id)->update($data);

        return redirect('/ns-admin/measures')->with('success', 'Measure updated successfully');
    }

    public function destroy($id)
    {
        $measure = Measure::where('id', $id)->first();

        if (isset($measure)) {

            $data = ([
                'delete_status' => '1',
            ]);

            Measure::where('id', $id)->update($data);

            return redirect('/ns-admin/measures')->with('success', 'Measure deleted successfully.');
        }
        return redirect('/ns-admin/measures')->with('error', 'Measure deletion failed.');
    }
}
