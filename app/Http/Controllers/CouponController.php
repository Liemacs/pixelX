<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    public function couponStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('coupons')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('coupons')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|min:2',
            'type' => 'required|in:fixed,percent',
            'status' => 'nullable|in:active,inactive',
            'value' => 'required|numeric'
        ]);
        $data = $request->all();
        $status = Coupon::create($data);
        if ($status) {
            return redirect()->route('coupon.index')->with('success', 'Coupon successfully created');
        } else {
            return back()->with('error', 'Something went wrong!');
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
        $coupon = Coupon::find($id);
        if ($coupon) {
            return view('backend.coupon.edit', compact('coupon'));
        } else return back()->with('error', 'Data not found');
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
        $coupon = Coupon::find($id);
        if ($coupon) {
            $this->validate($request, [
                'code' => 'required|min:2',
                'value' => 'required|numeric',
                'type' => 'required|in:fixed,percent',
            ]);

            $data = $request->all();

            $status = $coupon->fill($data)->save();
            if ($status) {
                return redirect()->route('coupon.index')->with('success', 'Coupon successfully updated');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Coupon not found');
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
        $coupon = Coupon::find($id);

        if ($coupon) {
            $status = $coupon->delete();
            if ($status) {
                return redirect()->route('coupon.index')->with('success', 'Coupon succeddfully deleted');
            } else return back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
