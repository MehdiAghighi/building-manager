@extends('admin.layouts.layout')
@section('content')
<div class="container py-6 mx-auto">
    <div class="w-full flex flex-col items-center justify-center">
        @if (session('status'))
            <div class="my-4 mx-2 border border-green-500 bg-green-300 rounded w-1/2 py-3 px-3" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="w-1/2 text-center my-5">
            <a href="{{ route('elan__create') }}" class="py-2 px-4 rounded-full border border-teal-700 bg-transparent text-teal-700 hover:bg-teal-700 hover:text-white hover:border-none focus:outline-none">اعلان جدید</a>
        </div>
    </div>
    <div class="overflow-auto px-1 my-2 mx-auto">
        <table class="table-auto mx-auto">
            <thead>
            <tr>
                <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">#</th>
                <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">تیتر</th>
                <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">توضیحات</th>
                <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">نوع</th>
                <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">تاریخ</th>
                <th class="border-2 border-blue-300 bg-blue-600 text-white  px-4 py-2 text-center font-bold text-lg">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($elans as $elan)
                <tr>
                    <td class="border-2 border-gray-300 px-4 py-2">{{ $elan['id'] }}</td>
                    <td class="border-2 border-gray-300 px-4 py-2 text-blue-700 underline hover:text-pink-700"><a href="{{ route('elan__show', ["id" => $elan['id']]) }}">{{ $elan['title'] }}</a></td>
                    <td class="border-2 border-gray-300  px-4 py-2">@if($elan['description']){{ $elan['description'] }}@endif</td>
                    <td class="border-2 border-gray-300  px-4 py-2">{{ $elan['type'] === "1" ? "عمومی" : "تبلیغ" }}</td>
                    <td class="border-2 border-gray-300  px-4 py-2">{{ new Verta($elan['created_at']) }}</td>
                    <td class="border-2 border-gray-300  px-4 py-2">
                        <form method="POST" action="{{ route('elan__destroy', ['id' => $elan['id']]) }}">
                            @csrf
                            <button class="text-red-500" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection