<?php

namespace App\Http\Controllers;

use App\Borj;
use function GuzzleHttp\Promise\is_settled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $chats = $borj->chats()->orderBy('created_at', 'desc')->get();

        return view('admin.pages.chat.index', [
            "user" => $user,
            "borj" => $borj->get()->toArray()[0],
            "chats" => $chats
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
        $user = auth('api')->user();
        $borj = Borj::find($user->borj_id)->first();

        if (!$borj) {
            return response()->json([
                "message" => "برج مورد نظر پیدا نشد"
            ], 404);
        }

        $data = $request->only(['title', 'text', 'image']);

        $rules = [
            'image' => ['nullable', 'file', 'image'],
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                "message" => "لطفا فیلد ها را درست وارد کنید",
                "errors" => $validator->errors()->toArray()
            ], 422);
        }

        $picPath = is_null($request->file('image')) ? null : $request->file('image')->store('chats');
        $picPath = is_null($picPath) ? null : str_replace('public/', '', $picPath);

        $chat = $user->chats()->create([
           'title' => $data['title'],
           'image' => $picPath,
           'text' => $data['text'],
            'borj_id' => $borj->id
        ]);

        return response()->json([
            "message" => "پیام ارسال شد",
            "chat" => $chat
        ], 201);

//        dd($data);
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
