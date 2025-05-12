<x-guest-layout>
    <div class="text-xl  text-red-600">
        {{ __('Chức năng vẫn đang trong tình trạng phát triển') }}
    </div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Chúng tôi sẽ gửi link đến email của bạn để đặt lại mật khẩu cho bạn!') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Xác nhận') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
