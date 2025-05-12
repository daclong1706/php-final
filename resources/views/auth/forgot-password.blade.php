<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left side - Image -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1616763355548-1b606f439f86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')">
            <div class="h-full w-full bg-gradient-to-r from-indigo-900/90 to-blue-900/70 flex items-center justify-center p-12">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-bold text-white mb-6">Quên mật khẩu?</h2>
                    <p class="text-xl text-white/90 mb-8">Đừng lo lắng! Chúng tôi sẽ giúp bạn khôi phục lại mật khẩu để tiếp tục học tập.</p>
                    <div class="flex space-x-4">
                        <div class="bg-white/20 p-4 rounded-lg backdrop-blur-sm shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="bg-white/20 p-4 rounded-lg backdrop-blur-sm shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - Form -->
        <div class="w-full md:w-1/2 bg-gradient-to-b from-gray-50 to-white flex items-center justify-center p-6 md:p-12">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <div class="h-16 w-16 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-xl flex items-center justify-center shadow-lg transform transition-transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Quên mật khẩu</h2>
                <p class="text-gray-600 text-center mb-6">Nhập email của bạn để nhận liên kết đặt lại mật khẩu</p>

                <div class="mb-6 p-4 bg-amber-50 rounded-lg border border-amber-100">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-amber-600 font-medium">{{ __('Chức năng vẫn đang trong tình trạng phát triển') }}</p>
                    </div>
                </div>

                <p class="mb-6 text-gray-600 text-center">
                    {{ __('Chúng tôi sẽ gửi link đến email của bạn để đặt lại mật khẩu cho bạn!') }}
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium text-sm mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email" class="block mt-1 w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" type="email" name="email" :value="old('email')" required autofocus placeholder="email@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex flex-col space-y-4">
                        <x-primary-button class="w-full justify-center bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            {{ __('Xác nhận') }}
                        </x-primary-button>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-150 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                {{ __('Quay lại đăng nhập') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
