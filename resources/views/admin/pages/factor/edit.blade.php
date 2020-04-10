@extends('admin.layouts.layout')
@section('content')
    <div class="container py-6 mx-auto">
        @if (session('errors'))
            <div class="my-4 mx-2 border border-red-500 bg-red-200 rounded w-1/2 mx-auto py-3 px-3" role="alert">
                @foreach($errors as $errorType)
                    @foreach($errorType as $error)
                        <h3>{{ $error }}</h3>
                    @endforeach
                @endforeach
            </div>
        @endif
        <div class="bg-white shadow-lg rounded w-2/3 mx-auto">
            <div class="w-full rounded-t border-b-2 border-green-500 bg-green-300 py-2 px-2 text-2xl mt-2">
                ویرایش فاکتور {{ $factor['title'] }}
            </div>
            <div class="py-2 px-3">
                <form method="POST" action="{{ route('factor__update', ['id' => $factor['id']]) }}" enctype="multipart/form-data">
                    @csrf
                    @foreach($mostajer_factors as $mostajer_factor)
                        <div class="flex flex-row items-center">
                            <label for="{{ $mostajer_factor['mostajer']['id'] }}" class="my-1 mx-2 text-lg">{{ $mostajer_factor['mostajer']['name'] }}</label>
                            <div class="mx-4 bg-purple-200 border border-purple-400 py-2 px-3 rounded my-2">
                                پرداخت شده ؟
                                <input id="{{ $mostajer_factor['mostajer']['id'] }}" @if($mostajer_factor['is_paid']) checked @endif type="checkbox" name="{{ $mostajer_factor['mostajer']['username'] }}" value="on" class=" my-1 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                            </div>
                            <label for="desc_{{ $mostajer_factor['mostajer']['id'] }}" class="my-1 mx-2 text-lg">توضیحات: </label>
                            <input id="desc_{{ $mostajer_factor['mostajer']['id'] }}" @if($mostajer_factor['description']) value="{{ $mostajer_factor['description'] }}" @endif class="px-2 border border-gray-500 bg-white rounded py-1 mx-2 my-1" type="text" name="desc_{{ $mostajer_factor['mostajer']['username'] }}" />
                        </div>
                    @endforeach
                    <div>
                        <button class="py-2 px-2 my-3 rounded-lg bg-white border border-teal-700 hover:bg-teal-700 hover:border-none hover:text-white">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection