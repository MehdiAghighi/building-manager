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
        <div class="bg-white shadow-lg rounded w-5/6 md:w-1/2 mx-auto">
            <div class="w-full rounded-t border-b-2 border-green-500 bg-green-300 py-2 px-2 text-2xl mt-2">
                ساخت اعلان
            </div>
            <div class="py-2 px-3">
                <form method="POST" action="{{ route('elan__store') }}" enctype="multipart/form-data">
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
                        <div>
                            <label for="type" class="my-1 text-lg">تبلیغاتی</label>
                            <input id="type" type="radio" name="type" value="0" class="my-1 mx-2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                        </div>
                        <div>
                            <label for="type" class="my-1 text-lg">عمومی</label>
                            <input id="type" type="radio" name="type" value="1" class="my-1 mx-2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                        </div>
                    </div>
                    <div>
                        <button class="py-2 px-2 my-3 rounded-lg bg-white border border-teal-700 hover:bg-teal-700 hover:border-none hover:text-white">ثبت اعلان</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection