@extends('admin.layouts.layout')
@section('content')
    <div class="container py-6 mx-auto">
        <div class="w-full flex flex-col items-center justify-center">
            @if (session('status'))
                <div class="my-4 mx-2 border border-green-500 bg-green-300 rounded w-1/2 py-3 px-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="w-3/4 text-center my-5">
                <a href="{{ route('mostajer__create') }}" class="py-2 px-4 rounded-full border border-teal-700 bg-transparent text-teal-700 hover:bg-teal-700 hover:text-white hover:border-none focus:outline-none">مستاجر جدید</a>
            </div>
        </div>
        <div class="overflow-auto px-1 my-2 mx-auto">
            <table class="table-auto mx-auto">
                <thead>
                <tr>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">#</th>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">نام</th>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">نام کاربری</th>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">شماره تماس</th>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">شارژ</th>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">واحد</th>
                    <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">طبقه</th>
                    {{--<th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">مهلت تا</th>--}}
                    {{--<th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">عملیات</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($mostajers) > 0)
                    @foreach($mostajers as $mostjaer)
                        <tr>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostjaer['id'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostjaer['name'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">@if($mostjaer['username']){{ $mostjaer['username'] }}@endif</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostjaer['phone'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostjaer['sharj_amount'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostjaer['vahed'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostjaer['tabaghe'] }}</td>
                            {{--<td class="border-2 border-gray-300  px-4 py-2">--}}
                                {{--<form method="POST" action="{{ route('factor__destroy', ['id' => $factor['id']]) }}">--}}
                                    {{--@csrf--}}
                                    {{--<button class="text-red-500" type="submit">حذف</button>--}}
                                {{--</form>--}}
                                {{--<a class="text-blue-500" href="{{ route('factor__edit', ['id' => $factor['id']]) }}">ویرایش</a>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection