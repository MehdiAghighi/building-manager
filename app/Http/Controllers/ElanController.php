<?php

namespace App\Http\Controllers;

use App\Elan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ElanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $borj = $user->borj;
        $elans = $borj->elans;

        return view('admin.pages.elan.index', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "elans" => $elans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $borj = $user->borj;

        return view('admin.pages.elan.create', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $borj = $user->borj;

        $rules = [
            'title' => ['required', 'string', 'max:191', 'min:3'],
            'description' => ['nullable', 'string', 'max:3000', 'min:5'],
            'image' => ['nullable', 'file', 'image'],
            'type' => ['required', 'numeric', 'boolean']
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('elan__create')->with('errors', $validator->errors()->toArray());
        }

        $picPath = is_null($request->file('image')) ? null : $request->file('image')->store('elans');
        $picPath = is_null($picPath) ? null : str_replace('public/', '', $picPath);

        $elan = new Elan($data);
        $elan->image = $picPath;

        $borj->elans()->save($elan);

        return redirect()->route('elan__index')->with('status', 'اعلان با موفقیت ذخیره شد');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $borj = $user->borj;

        $elan = $borj->elans->find($id);

        if (!$elan) {
            return redirect()->route('elan__index')->with('errors', 'این اعلان وجود ندارد');
        }
        return view('admin.pages.elan.show', [
            "user" => $user,
            "borj" => $borj,
            "elan" => $elan->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $borj = $user->borj;
        $elan = $borj->elans->find($id);

        if (!$elan) {
            return redirect()->route('elan__index')->with('errors', 'این اعلان وجود ندارد');
        }

        if ($elan->image) {
            if ($elan->delete()) {
                $picPath = $elan->image;
                Storage::delete($picPath);
            }
        } else {
            $elan->delete();
        }

        return redirect()->route('elan__index')->with('status', 'اعلان با موفقیت پاک شد');
    }
}
