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