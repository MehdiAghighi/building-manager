<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
        $chats = $borj->chats;

        return view('admin.pages.chat.index', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "chats" => $chats->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

        $chat = $borj->chats->find($id);

        if (!$chat) {
            return redirect()->route('elan__index')->with('errors', 'این چت وجود ندارد');
        }

        return view('admin.pages.chat.show', [
            "user" => $user,
            "borj" => $borj,
            "chat" => $chat->toArray()
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
        $chat = $borj->chats->find($id);

        if (!$chat) {
            return redirect()->route('chat__index')->with('errors', 'این چت وجود ندارد');
        }

        if ($chat->image) {
            if ($chat->delete()) {
                $picPath = $chat->image;
                Storage::delete('public/' . $picPath);
            }
        } else {
            $chat->delete();
        }

        return redirect()->route('chat__index')->with('status', 'چت با موفقیت پاک شد');
    }
}
