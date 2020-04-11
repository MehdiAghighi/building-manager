<?php

namespace App\Http\Controllers;

use App\factor;
use App\MostajerFactor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FactorController extends Controller
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
        $factors = $borj->factors()->with('mostajerFactors');

        $factors_array = $factors->get()->toArray();

        foreach($factors->get() as $key => $factor) {
            $paid_count = $factor->mostajerFactors->where('is_paid', 1)->count();
            $factors_array[$key]['mostajers_paid_count'] = $paid_count;
        }

        return view('admin.pages.factor.index', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "factors" => $factors_array,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function personIndex()
    {
        $user = auth('api')->user()->with('borj')->first();
        $mostajer_factors = MostajerFactor::where('mostajer_id', $user->id)->with('factor')->orderBy('created_at', 'desc')->get();

        return response()->json([
            "message" => "فاکتور‌ها با موفقیت دریافت شد",
            "mostajer_factors" => $mostajer_factors
        ], 200);
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
//        $factors = $borj->factors;
        $mostajers = $borj->mostajers;

        return view('admin.pages.factor.create', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "mostajers" => $mostajers
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


        $mostajer_factors = [];

        $rules = [
            'title' => ['required', 'string', 'max:191', 'min:3'],
            'description' => ['nullable', 'string', 'max:3000', 'min:5'],
            'image' => ['nullable', 'file', 'image'],
            'amount' => ['required', 'numeric'],
            'exp_date' => ['required', 'numeric']
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('factor__create')->with('errors', $validator->errors()->toArray());
        }

        $amount = $data['amount'];

        $mostajer_tedad = 0;

        $user = Auth::user();
        $borj = $user->borj;
        $mostajers = $borj->mostajers;

        if (!array_key_exists('everybody', $data)) {
            foreach ($mostajers as $mostajer) {
                foreach ($data as $key => $value) {
                    if ($key === $mostajer['username']) {
                        unset($data[$key]);
                        $mostajer_tedad++;
                        $mostajer_factor = new MostajerFactor([
                            "mostajer_id" => $mostajer['id'],
                            "is_paid" => false,
                            "rahgiri" => uniqid('FR_', true)
                        ]);
                        array_push($mostajer_factors, $mostajer_factor);
                    }
                }
            }
        } else {
            unset($data['everybody']);
            foreach ($mostajers as $mostajer) {

                $mostajer_tedad++;
                $mostajer_factor = new MostajerFactor([
                    "mostajer_id" => $mostajer['id'],
                    "is_paid" => false,
                    "rahgiri" => uniqid('FR_', true)
                ]);
                array_push($mostajer_factors, $mostajer_factor);
            }
        }


//        dd($mostajer_factors, $mostajer_tedad, $amount / $mostajer_tedad, $data);

        $picPath = is_null($request->file('image')) ? null : $request->file('image')->store('factors');
        $picPath = is_null($picPath) ? null : str_replace('public/', '', $picPath);

        $data['exp_date'] = Carbon::now()->addDays((int)$data['exp_date']);
        $factor = new factor([
            "title" => $data['title'],
            "amount" => $data['amount'],
            "exp_date" => $data['exp_date']
        ]);
        if (isset($data['description'])) {
            $factor->description = $data['description'];
        }
        $factor->image = $picPath;

        $factor = $borj->factors()->save($factor);

        foreach ($mostajer_factors as $key => $mostajer_factor) {
            $mostajer_factor->amount = $amount / $mostajer_tedad;
        }

        $factor->mostajerFactors()->saveMany($mostajer_factors);

        return redirect()->route('factor__index')->with('status', 'فاکتور با موفقیت ذخیره شد');
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
        $factor = $borj->factors->find($id);
        if (!$factor) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }
        $mostajer_factors = $factor->mostajerFactors()->with('mostajer');

        return view('admin.pages.factor.show', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "factor" => $factor,
            "mostajer_factors" => $mostajer_factors->get()->toArray(),
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
        $user = Auth::user();
        $borj = $user->borj;
        $factor = $borj->factors->find($id);
        if (!$factor) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }
        $mostajer_factors = $factor->mostajerFactors()->with('mostajer');
//        $mostajers = $borj->mostajers;
        return view('admin.pages.factor.edit', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "factor" => $factor,
            "mostajer_factors" => $mostajer_factors->get()->toArray(),
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

//        $rules = [
//            'description' => ['nullable', 'string', 'max:3000', 'min:5'],
//        ];
//
//        $validator = Validator::make($data, $rules);
//
//        if ($validator->fails()) {
//            return redirect()->route('factor__create')->with('errors', $validator->errors()->toArray());
//        }

        $user = Auth::user();
        $borj = $user->borj;
        $factor = $borj->factors->find($id);
        if (!$factor) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }

        $last_array = [];

        $mostajer_factors = $factor->mostajerFactors()->with('mostajer')->get();
        $mostajer_factors_array = $mostajer_factors->toArray();

        foreach($mostajer_factors_array as $key => $mostajer_factor) {
            if (array_key_exists($mostajer_factor['mostajer']['username'], $data)) {
                if (array_key_exists('desc_' . $mostajer_factor['mostajer']['username'], $data)) {
                    $mostajer_factors[$key]->description = $data['desc_' . $mostajer_factor['mostajer']['username']];
                }
                $mostajer_factors[$key]->is_paid = 1;
                $mostajer_factors[$key]->save();
            } else {
                if ($mostajer_factors[$key]->is_paid) {
                    $mostajer_factors[$key]->is_paid = 0;
                    $mostajer_factors[$key]->save();
                }
            }
        }

        return redirect()->route('factor__index')->with('status', 'فاکتور با موفقیت ذخیره شد');
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
        $factor = $borj->factors->find($id);

        if (!$factor) {
            return redirect()->route('factor__index')->with('errors', 'این فاکتور وجود ندارد');
        }

        if ($factor->image) {
            if ($factor->delete()) {
                $picPath = $factor->image;
                Storage::delete($picPath);
            }
        } else {
            $factor->delete();
        }

        return redirect()->route('factor__index')->with('status', 'فاکتور با موفقیت پاک شد');
    }
}
