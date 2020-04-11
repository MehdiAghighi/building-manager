<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    @include('admin.layouts.head')
</head>
<body class="bg-gray-900 font-sans leading-normal tracking-normal mt-12">
<!--Nav-->
<nav class="bg-gray-900 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

    <div class="flex flex-wrap items-center">
        <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-teal-100">
            <h1 class="text-3xl text-teal-100">
                برج {{ $borj['name'] }}
            </h1>
        </div>

        <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                <span class="relative w-full">
                    <input type="search" placeholder="جست و جو"
                           class="w-full bg-gray-800 text-sm text-white transition border border-transparent focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: .5rem; left: .8rem;">
                        <svg class="fill-current pointer-events-none text-white w-4 h-4"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                            </path>
                        </svg>
                    </div>
                </span>
        </div>

        <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
            <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                {{--<li class="flex-1 md:flex-none md:mr-3">--}}
                    {{--<a class="inline-block py-2 px-4 text-white no-underline" href="#">فعالیت</a>--}}
                {{--</li>--}}
                {{--<li class="flex-1 md:flex-none md:mr-3">--}}
                    {{--<a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"--}}
                       {{--href="#">لینک</a>--}}
                {{--</li>--}}
                <li class="flex-1 md:flex-none md:mr-3">
                    <div class="relative inline-block">
                        <button class="text-white focus:outline-none mx-2 my-1">
                            سلام، {{ $user->name }}
                        </button>
                    </div>
                    <div class="relative inline-block">
                        <form method="POST" action="{{ route('logout')  }}">
                            @csrf
                            <button type="submit" class="text-white focus:outline-none mx-2 my-1">
                                خروج
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="flex flex-col md:flex-row">
    <div class="bg-gray-900 shadow-lg h-16 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48">

        <div
                class="md:mt-12 md:w-48 md:fixed md:right-0 md:top-0 content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 md:text-left">
                <li class="ml-3 flex-1">
                    <a href="{{ route('home') }}"
                       class="block text-center py-1 md:text-right md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ (request()->is('home')) ? 'border-pink-500' : 'border-gray-800' }} hover:border-pink-500">
                        <i class="fas fa-tasks pr-0 md:pl-3 {{ (request()->is('home')) ? 'text-pink-500' : '' }}"></i><span
                                class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">داشبورد</span>
                    </a>
                </li>
                <li class="ml-3 flex-1">
                    <a href="{{ route('elan__index') }}"
                       class="block text-center py-1 md:text-right md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ (request()->is('elans')) ? 'border-purple-500' : 'border-gray-800' }} hover:border-purple-500">
                        <i class="fa text-center fa-envelope pr-0 md:pl-3 {{ (request()->is('elans')) ? 'text-purple-500' : '' }}"></i><span
                                class="pb-1 text-center md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">اعلان‌ها</span>
                    </a>
                </li>
                <li class="ml-3 flex-1">
                    <a href="{{ route('chat__index') }}"
                       class="block text-center py-1 md:text-right md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ (request()->is('chat')) ? 'border-blue-600' : 'border-gray-800' }} hover:border-blue-600">
                        <i class="fas fa-chart-area pr-0 md:pl-3 {{ (request()->is('chat')) ? 'text-blue-600' : '' }}"></i><span
                                class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">پیام‌ها</span>
                    </a>
                </li>
                <li class="ml-3 flex-1">
                    <a href="{{ route('factor__index') }}"
                       class="block text-center py-1 md:text-right md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ (request()->is('factor')) ? 'border-red-500' : 'border-gray-800' }} hover:border-red-500">
                        <i class="fa fa-wallet pr-0 md:pl-3 {{ (request()->is('factor')) ? 'text-red-500' : '' }}"></i><span
                                class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">فاکتور‌ها</span>
                    </a>
                </li>
                <li class="ml-3 flex-1">
                    <a href="{{ route('mostajer__index') }}"
                       class="block text-center py-1 md:text-right md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ (request()->is('mostajers')) ? 'border-green-500' : 'border-gray-800' }} hover:border-green-500">
                        <i class="fa fa-user pr-0 md:pl-3 {{ (request()->is('mostajers')) ? 'text-green-500' : '' }}"></i><span
                                class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">مستاجر‌ها</span>
                    </a>
                </li>
            </ul>
        </div>


    </div>
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        @yield('content')
    </div>
</div>
</body>