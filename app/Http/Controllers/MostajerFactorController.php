<?php

namespace App\Http\Controllers;

use App\MostajerFactor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MostajerFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = Auth::user();
        $borj = $user->borj;
        $mostajer_factor = MostajerFactor::where('id', $id)->with('mostajer');

        if (!$mostajer_factor->first()) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }

        $check_factor = $borj->factors->where('id', $mostajer_factor->first()->toArray()['factor_id']);

        if (!$check_factor->first()) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }

//        dd($mostajer_factor->get()->toArray());

        /// TODO:: Redirect if was not for this borj

        return view('admin.pages.factor.mostajer.edit', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
//            "factor" => $factor,
            "mostajer_factor" => $mostajer_factor->first()->toArray(),
        ]);
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
        $data = $request->all();

        $user = Auth::user();
        $borj = $user->borj;
        $mostajer_factor = MostajerFactor::where('id', $id)->with('mostajer');

        if (!$mostajer_factor->first()) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }

        $check_factor = $borj->factors->where('id', $mostajer_factor->first()->toArray()['factor_id']);

        if (!$check_factor->first()) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }

        $mostajer_factor = $mostajer_factor->first();

        $mostajer_factor->description = $data['description'];

        if (isset($data['is_paid'])) {
            if (!$mostajer_factor->is_paid) {
                $mostajer_factor->is_paid = 1;
                $mostajer_factor->pay_date = Carbon::now();
            }
        } else {
            $mostajer_factor->is_paid = 0;
            $mostajer_factor->pay_date = null;
        }

        $mostajer_factor->save();

        return redirect()->route('factor__show', ['id' => $mostajer_factor->factor_id])->with('status', 'با موفقیت آپدیت شد');

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
