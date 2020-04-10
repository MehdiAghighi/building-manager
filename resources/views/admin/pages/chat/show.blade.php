@extends('admin.layouts.layout')
@section('content')
    <div class="container mx-auto my-3">
        <div class="w-full md:w-1/2 mx-auto bg-white rounded shadow-lg">
            <div class="rounded-t-lg bg-gray-200 border-b-2 border-gray-400 w-full text-xl py-2 px-3">
                {{ $chat['title'] }}
            </div>
            <div class="py-2 px-3">
                <div class="w-1/2 mx-auto">
                    @if ($chat['image'])
                        <img src="{{ Storage::url($chat['image']) }}" />
                    @endif
                </div>
                <div class="bg-gray-200 border border-gray-400 rounded py-2 px-3 my-3">
                    @if($chat['text']){{ $chat['text'] }}@endif
                </div>
                <div class="flex flex-row items-center justify-center">
                    <div class="w-1/3 border border-blue-400 bg-blue-200 rounded py-2 px-3 my-3 text-center my-1 mx-2">
                        {{ $chat['mostajer']['name'] }}
                    </div>
                    <div class="w-1/3 border border-red-400 bg-red-200 rounded py-2 px-3 my-3 text-center my-1 mx-2">
                        {{ new Verta($chat['created_at']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection