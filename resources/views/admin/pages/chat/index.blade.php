@extends('admin.layouts.layout')
@section('content')
    <div class="container py-6 mx-auto">
        <div class="w-full flex flex-col items-center justify-center">
            @if (session('status'))
                <div class="my-4 mx-2 border border-green-500 bg-green-300 rounded w-1/2 py-3 px-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="overflow-auto px-1 my-2 w-full flex flex-col items-center justify-center">
            <table class="table-auto">
                <thead>
                <tr>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">#</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">تیتر</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">توضیحات</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">تاریخ</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">مستاجر</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">عملیات</td>
                </tr>
                </thead>
                <tbody>
                @foreach($chats as $chat)
                    <tr>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $chat['id'] }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 text-blue-700 underline hover:text-pink-700"><a href="{{ route('chat__show', ["id" => $chat['id']]) }}">{{ $chat['title'] }}</a></td>
                        <td class="border-2 border-gray-300  px-4 py-2">@if($chat['text']){{ $chat['text'] }}@endif</td>
                        <td class="border-2 border-gray-300  px-4 py-2">{{ new Verta($chat['created_at']) }}</td>
                        <td class="border-2 border-gray-300  px-4 py-2">{{ $chat['mostajer']['name'] }}</td>
                        <td class="border-2 border-gray-300  px-4 py-2">
                            <form method="POST" action="{{ route('chat__destroy', ['id' => $chat['id']]) }}">
                                @csrf
                                <button class="text-red-500" type="submit">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection