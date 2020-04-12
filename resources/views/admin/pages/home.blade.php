@extends('admin.layouts.layout')
@section('content')
    <div class="bg-blue-800 p-2 shadow text-xl text-white">
        <h3 class="font-bold pl-2">آمار</h3>
    </div>

    <div class="py-2 px-4">
        @if (session('status'))
            <div class="my-4 mx-2 border-green-500 bg-green-300 rounded w-full" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-green-100 border-b-4 border-green-600 rounded-lg shadow-lg p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i>
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-600">پیام‌های جدید</h5>
                            <h3 class="font-bold text-3xl">{{ $chats_count }} <span class="text-green-500"><i
                                            class="fas fa-caret-up"></i></span></h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-orange-100 border-b-4 border-orange-500 rounded-lg shadow-lg p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-orange-600"><i
                                        class="fas fa-users fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-600">اعلان‌ها</h5>
                            <h3 class="font-bold text-3xl">{{ $elans_count }} <span class="text-orange-500"><i
                                            class="fas fa-exchange-alt"></i></span></h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-lg p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-yellow-600"><i
                                        class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-600">مستاجرین</h5>
                            <h3 class="font-bold text-3xl">{{ $mostajerin_count }} <span class="text-yellow-600"><i
                                            class="fas fa-caret-up"></i></span></h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
                <a href="{{route('push')}}" class="py-2 px-4 rounded bg-teal-800 text-white text-xl m-5">Make a Push Notification!</a>
            </div>
        </div>
    </div>
@endsection
