@extends('admin.layouts.layout')
@section('content')
    <div class="container mx-auto my-3">
        <div class="w-4/5 mb-5 lg:w-1/2 mx-auto bg-white rounded shadow-lg">
            <div class="rounded-t bg-gray-200 border-b-2 border-gray-400 w-full text-xl py-2 px-3">
                {{ $factor['title'] }}
            </div>
            <div class="py-2 px-3">
                <div class="w-4/5 sm:w-1/2 mx-auto">
                    @if ($factor['image'])
                        <img src="{{ Storage::url($factor['image']) }}" />
                    @endif
                </div>
                <div class="bg-gray-200 border border-gray-400 rounded py-2 px-3 my-3">
                    @if($factor['description']){{ $factor['description'] }}@endif
                </div>
                <div class="w-1/3 border border-purple-400 bg-purple-200 rounded py-2 px-3 my-3 text-center my-1 mx-2 mx-auto">
                    ساخته شده توسط {{ $factor['built'] == "0" ? "سیستم" : "مدیر" }}
                </div>
                <div class="flex flex-row items-center justify-center">
                    <div class="w-1/3 border border-teal-700 bg-teal-700 rounded py-2 px-3 my-3 text-center my-1 mx-2 text-white">
                        <span class="block font-bold">تاریخ ایجاد</span>
                        {{ new Verta($factor['created_at']) }}
                    </div>
                    <div class="w-1/3 border border-teal-700 bg-teal-700 rounded py-2 px-3 my-3 text-center my-1 mx-2 text-white">
                        <span class="block font-bold">مهلت تا</span>
                        {{ new Verta($factor['exp_date']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-auto px-1 my-2 mx-auto">
            <table class="table-auto mx-auto">
                <thead>
                <tr>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">#</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">نام مستاجر</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">توضیحات</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">هزینه</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">پرداخت</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">کد رهگیری</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">تاریخ</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">تاریخ پرداخت</td>
                    <td class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">عملیات</td>
                </tr>
                </thead>
                <tbody>
                @if(count($mostajer_factors) > 0)
                    @foreach($mostajer_factors as $mostajer_factor)
                        <tr>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostajer_factor['id'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostajer_factor['mostajer']['name'] }}</td>
                            <td class="border-2 border-gray-300  px-4 py-2">@if($mostajer_factor['description']){{ $mostajer_factor['description'] }}@endif</td>
                            <td class="border-2 border-gray-300 px-4 py-2">{{ $mostajer_factor['amount'] }}</td>
                            <td class="border-2 border-gray-300 px-4 py-2">@if($mostajer_factor['is_paid'])  شده @else نشده @endif</td>
                            <td class="border-2 border-gray-300  px-4 py-2">{{ $mostajer_factor['rahgiri'] }}</td>
                            <td class="border-2 border-gray-300  px-4 py-2">{{ new Verta($mostajer_factor['created_at']) }}</td>
                            <td class="border-2 border-gray-300  px-4 py-2">@if($mostajer_factor['pay_date']){{ new Verta($mostajer_factor['pay_date']) }}@endif</td>
                            <td class="border-2 border-gray-300  px-4 py-2">
                                <a class="text-blue-500" href="{{ route('factor-mostajer__edit', ['id' => $mostajer_factor['id']]) }}">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection