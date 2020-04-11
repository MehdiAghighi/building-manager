<?php

namespace App\Http\Controllers;

use App\Mostajer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MostajerController extends Controller
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
        $mostajers = $borj->mostajers;

        return view('admin.pages.mostajer.index', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "mostajers" => $mostajers
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

        return view('admin.pages.mostajer.create', [
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
            'name' => ['required', 'string', 'max:191', 'min:3'],
            'username' => ['required', 'string', 'max:200', 'min:3'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
            'phone' => ['required', 'numeric'],
            'sharj_amount' => ['required', 'numeric'],
            'vahed' => ['required', 'numeric'],
            'tabaghe' => ['required', 'numeric']
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('mostajer__create')->with('errors', $validator->errors()->toArray());
        }

        $mostajer = new Mostajer([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'sharj_amount' => $data['sharj_amount'],
            'vahed' => $data['vahed'],
            'tabaghe' => $data['tabaghe']
        ]);
//        $elan->image = $picPath;

        $borj->mostajers()->save($mostajer);

        return redirect()->route('mostajer__index')->with('status', 'مستاجر با موفقیت ذخیره شد');

    }

    public function me(Request $request)
    {
        try {
            return response()->json([
                "message" => "کاربر با موفقیت دریافت شد"
            ], 200);
        } catch (\Exception $err) {
            throw new \Exception('', 500);
        }
    }
}
