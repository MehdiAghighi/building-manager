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
                ساخت مستاجر
            </div>
            <div class="py-2 px-3">
                <form method="POST" action="{{ route('mostajer__store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="my-1 text-lg">نام</label>
                        <input id="name" type="text" name="name" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="username" class="my-1 text-lg">نام کاربری</label>
                        <input id="username" type="text" name="username" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="password" class="my-1 text-lg">رمز عبور کاربر</label>
                        <input id="password" type="text" name="password" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="phone" class="my-1 text-lg">شماره تماس</label>
                        <input id="phone" type="text" name="phone" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="sharj_amount" class="my-1 text-lg">شارژ</label>
                        <input id="sharj_amount" type="text" name="sharj_amount" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="vahed" class="my-1 text-lg">واحد</label>
                        <input id="vahed" type="number" name="vahed" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div class="flex flex-col">
                        <label for="tabaghe" class="my-1 text-lg">طبقه</label>
                        <input id="tabaghe" type="number" name="tabaghe" class="my-1 w-full sm:w-1/2 py-1 px-2 bg-white border-2 rounded border-gray-300 focus:bg-gray-100 focus:border-none focus:outline-none" />
                    </div>
                    <div>
                        <button class="py-2 px-2 my-3 rounded-lg bg-white border border-teal-700 hover:bg-teal-700 hover:border-none hover:text-white">ثبت مستاجر</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection