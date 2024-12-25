<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- form frame --}}
    <div class="fixed flex bg-scndBlue w-3/6 h-3/5 shadow-xl mb-10 rounded-xl">
        <div class="flex-[1.2] flex justify-center items-center flex-col">

            <img src="{{ asset('images/ctu.png') }}" alt="" class="w-28">
            <h1 class=" text-white text-lg font-light mt-1">Chào mừng trở lại</h1>

            <h1 class="font-extrabold text-2xl text-white mb-14 mt-2" style="font-size: 27px">CICT Indoor</h1>
        </div>
        <form method="POST" action="{{ route('login') }}" class="flex-[2] bg-white">
            @csrf
            {{-- <div class="fixed w-2/5 h-3/5 hidden bg-white shadow-xl mb-10 rounded-xl" id="authForm"> --}}
            <div class="px-12 flex flex-col h-full">
                <h1
                    class="h-full text-scndBlue text-2xl font-extrabold text-center mb-5 flex-[3] items-center flex mt-5">
                    Đăng nhập</h1>


                <div class="flex-[7] h-full">
                    <!-- Email Address -->
                    <div class="mb-5">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full focus:border-scndBLue focus:ring-1"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Mật khẩu')" />

                        <x-text-input id="password" class="block mt-1 w-full focus:border-scndBlue" type="password"
                            name="password" required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="
                            rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-600 shadow-sm focus:ring-gray-500 dark:focus:ring-gray-600 dark:focus:ring-offset-gray-800
                            active:border-scndBlue"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ghi nhớ tôi') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex-[5] h-full justify-center h-full pb-8">
                    <div class="flex items-center justify-end mt-2">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Quên mật khẩu?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-3 bg-scndBlue h-12 hover:bg-thirdBlue">
                            {{ __('Đăng nhập') }}
                        </x-primary-button>
                    </div>
                    <div class="flex items-center justify-center gap-2 mt-5">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Chưa có tài khoản?') }}
                            </a>
                        @endif

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-scndBlue dark:text-primaryBlue font-bold hover:text-gray-700 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('register') }}">
                                {{ __('Đăng ký ngay!') }}
                            </a>
                        @endif
                    </div>
                </div>


            </div>

            {{-- </div> --}}
        </form>
    </div>

</x-guest-layout>