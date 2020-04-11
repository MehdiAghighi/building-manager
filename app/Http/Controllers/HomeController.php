<?php

namespace App\Http\Controllers;

use App\Elan;
use App\Factor;
use App\MostajerFactor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $borj = $user->borj;
        $elans = $borj->elans->count();
        $chats = $borj->chats->where('created_at', '>', Carbon::now()->subDays(10))->count();
        $mostajerin = $borj->mostajers->count();
//        dd($chats);
//        dd($elans->count());
//        dd($user->get()->toArray()[0]['name']);
        return view('admin.pages.home', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "elans_count" => $elans,
            "chats_count" => $chats,
            "mostajerin_count" => $mostajerin
        ]);
    }

    public function home() {
        $user = auth('api')->user()->with('borj')->first();
//        dd($user->borj->id);
        $last_elan = Elan::where("borj_id", $user->borj->id)->orderBy('created_at', 'desc');
        $last_factor = MostajerFactor::where("mostajer_id", $user->id)->orderBy('created_at', 'desc')->with('factor');

        return response()->json([
            "message" => "اطلاعات با موفقیت دریافت شد",
            "user" => $user,
            "elan" => $last_elan->first(),
            "mostajer_factor" => $last_factor->first()
        ], 200);

//        dd($last_elan->first());
    }
}
