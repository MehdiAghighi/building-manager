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
        <div class="bg-white shadow-lg rounded w-3/4 mx-auto">
            <div class="w-full rounded-t border-b-2 border-green-500 bg-green-300 py-2 px-2 text-2xl mt-2">
                ساخت فاکتور
            </div>
            <div class="py-2 px-3">
                <form method="POST" action="{{ route('factor__store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col">
                        <label for="title" class="my-1 text-lg">تیتر</label>
                        <input id="title" type="text" name="title" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="description" class="my-1 text-lg">توضیحات</label>
                        <textarea id="description" rows="5" type="text" name="description" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none"></textarea>
                    </div>
                    <div class="flex flex-col">
                        <label for="image" class="my-1 text-lg">عکس</label>
                        <input id="image" type="file" name="image" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="amount" class="my-1 text-lg">هزینه</label>
                        <input id="amount" type="number" name="amount" class=" my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="exp_date" class="my-1 text-lg">مهلت پرداخت ( روز )</label>
                        <input id="exp_date" type="number" name="exp_date" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-row items-center bg-pink-200 border border-pink-400 py-2 px-4 rounded w-2/3 sm:w-1/4">
                        <label for="everybody" class="my-1 text-lg">همه‌ی مستاجرین</label>
                        <input id="everybody" type="checkbox" name="everybody" class=" my-1 mx-2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    @foreach($mostajers as $mostajer)
                        <div class="flex flex-row items-center">
                            <label for="{{ $mostajer['id'] }}" class="my-1 mx-2 text-lg">{{ $mostajer['name'] }}</label>
                            <input id="{{ $mostajer['id'] }}" type="checkbox" name="{{ $mostajer['username'] }}" value="on" class=" my-1 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                        </div>
                    @endforeach
                    <div>
                        <button class="py-2 px-2 my-3 rounded-lg bg-white border border-teal-700 hover:bg-teal-700 hover:border-none hover:text-white">ثبت فاکتور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection