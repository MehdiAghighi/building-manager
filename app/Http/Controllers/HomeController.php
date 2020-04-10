<?php

namespace App\Http\Controllers;

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
}
