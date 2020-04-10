@extends('layouts.app')
@section('nav')
    <nav class="w-full bg-gray-200 shadow-md">
        <div class="w-full flex flex-row items-center justify-between container mx-auto py-1">
            <div class="p-2">
                <h1 class="text-2xl text-teal-900">
                    {{ config('app.name', 'مدیریت')  }}
                </h1>
            </div>
            @guest
                <div>
                    @if(Route::has('register'))
                        <a class="p-3 rounded-lg hover:bg-gray-300 mx-2 cursor-pointer" href="{{ route('register') }}">
                            ثبت نام
                        </a>
                    @endif
                    <a class="p-3 rounded-lg hover:bg-gray-300 mx-2 cursor-pointer" href="{{ route('login') }}">
                        ورود
                    </a>
                </div>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-3 rounded-lg hover:bg-gray-300 mx-2 cursor-pointer">
                        خروج
                    </button>
                </form>
            @endauth
        </div>
    </nav>
@endsection
@section('content')
<div class="container mx-auto">
    <div class="w-full flex items-center justify-center">
        <div class="w-1/2">
            <div class="w-full bg-white shadow-xl rounded-lg">
                <div class="w-full px-5 py-3 bg-gray-300 border-b-2 border-gray-400 rounded-t-lg text-xl">ثبت نام</div>

                <div class="px-5 py-3">
                    @if($errors->any())
                        <div class="w-full py-2 px-3 border border-red-400 bg-red-100 rounded">
                            <ul class="">
                                @foreach($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="w-1/3 text-right">نام</label>

                            <div class="w-1/2">
                                <input id="name" type="text" class="w-full rounded px-3 py-1 border border-gray-300 focus:outline-none focus:border-gray-400 focus:bg-gray-100 m-2 @error('name') border-red-400 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="w-1/3 text-right">نام کاربری</label>

                            <div class="w-1/2">
                                <input id="username" type="username" class="w-full rounded px-3 py-1 border border-gray-300 focus:outline-none focus:border-gray-400 focus:bg-gray-100 m-2 @error('username') border-red-400 @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="w-1/3 text-right">شماره تلفن</label>

                            <div class="w-1/2">
                                <input id="phone" type="phone" class="w-full rounded px-3 py-1 border border-gray-300 focus:outline-none focus:border-gray-400 focus:bg-gray-100 m-2 @error('phone') border-red-400 @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="w-1/3 text-right">رمز عبور</label>

                            <div class="w-1/2">
                                <input id="password" type="password" class="w-full rounded px-3 py-1 border border-gray-300 focus:outline-none focus:border-gray-400 focus:bg-gray-100 m-2 @error('password') border-red-400 @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="w-1/3 text-right">تایید رمز عبور</label>

                            <div class="w-1/2">
                                <input id="password-confirm" type="password" class="w-full rounded px-3 py-1 border border-gray-300 focus:outline-none focus:border-gray-400 focus:bg-gray-100 m-2 @error('password-confirm') border-red-400 @enderror" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="my-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="py-2 px-5 font-semibold rounded-lg border border-teal-700 bg-white hover:border-none hover:bg-teal-700 hover:text-white transition duration-200">
                                    ثبت نام
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
