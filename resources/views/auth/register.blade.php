<x-guest-layout>
    <div class="fixed flex bg-scndBlue w-7/12 h-4/6 shadow-xl mb-10 rounded-xl">
        <div class="flex-[1.2] flex justify-center items-center flex-col">

            <img src="{{ asset('images/ctu.png') }}" alt="" class="w-28">
            <h1 class=" text-white text-lg font-light mt-1">Chào mừng đến với</h1>

            <h1 class="font-extrabold text-2xl text-white mb-14 mt-2" style="font-size: 27px">CICT Indoor</h1>
        </div>
        <form method="POST" action="{{ route('register') }}" class="flex-[2] bg-white">
            @csrf
            <div class="px-14 flex flex-col h-full">
                <h1
                    class="h-full text-scndBlue text-2xl font-extrabold text-center flex-[2] items-center flex mt-5">
                    Đăng ký</h1>

                <div class="flex-[7] h-full">
                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Tên của bạn')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Mật khẩu')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Xác nhận lại mật khẩu')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                </div>

                <div class="flex items-center justify-end mt-4 mb-5 flex-[3] mb-5">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Đã có tài khoản?') }}
                    </a>

                    <x-primary-button class="ms-3 bg-scndBlue h-12 hover:bg-thirdBlue">
                        {{ __('Đăng ký') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>