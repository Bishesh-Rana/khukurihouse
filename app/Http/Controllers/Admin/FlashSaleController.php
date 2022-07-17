<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;

class FlashSaleController extends Controller
{
    public function __construct(FlashSale $flashSale)
    {
        $this->flashSale = $flashSale;
        // $this->middleware(['permission:create_flash_sale'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:update_flash_sale'], ['only' => ['update', 'edit']]);
        // $this->middleware(['permission:delete_flash_sale'], ['only' => ['delete']]);
        // $this->middleware(['permission:browse_flash_sale'], ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashSales = $this->flashSale->with('product')->latest()->paginate(20);
        return view('admin.list.flashsale', compact('flashSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flashSale = new FlashSale();
        return view('admin.form.flashsale', compact('flashSale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =   $this->validate($request, $this->getRules());
        try {
            $this->flashSale->create($data);
            request()->session()->flash('success', 'Flash Sale Added');
            return redirect()->route('flash-sale.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Flash Cannot be Added At the moment');
            return back()->withInput();
        }
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
        $flashSale = $this->flashSale->with('product')->findorfail($id);
        return view('admin.form.flashsale', compact('flashSale'));
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
        $flashSale = $this->flashSale->findorfail($id);
        $data =   $this->validate($request, $this->getRules());
        try {
            $flashSale->update($data);
            request()->session()->flash('success', 'Flash Sale updated');
            return redirect()->route('flash-sale.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Flash Cannot be updated At the moment');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function getRules(): array
    {
        return [
            'productId' => ['required', 'exists:tbl_products,id'],
            'startTime' => ['required', 'date'],
            'endTime' => ['required', 'date'],
            'discount' => ['required', 'numeric'],
            'totalStock' => ['required', 'numeric'],
        ];
    }
}
