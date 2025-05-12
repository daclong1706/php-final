<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($cartItems->count())
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-center py-4 border-b">
                                <div class="flex items-center space-x-4">
                                    @if($item->course->video_url)
                                        @php
                                            $videoId = '';
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $item->course->video_url, $match)) {
                                                $videoId = $match[1];
                                            }
                                        @endphp
                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/default.jpg" 
                                             alt="{{ $item->course->name }}"
                                             class="w-24 h-18 object-cover rounded-lg">
                                    @endif
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ $item->course->name }}</h3>
                                        <p class="text-gray-600">{{ $item->course->subject }} - Lớp {{ $item->course->grade }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-lg font-bold">{{ number_format($item->course->price) }} VND</span>
                                    <form action="{{ route('cart.remove', $item->course) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                        <form action="{{ route('vnpay.create-payment') }}" method="POST" class="mt-6">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $total }}">
                            <input type="hidden" name="language" value="vn">
                            <div class="mt-6 flex justify-between items-center">
                                <span class="text-xl font-bold">Tổng cộng:</span>
                                <span class="text-2xl font-bold">{{ number_format($total) }} VND</span>
                            </div>
                            
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Thanh toán
                            </button>
                        </form>
                    @else
                        <p class="text-gray-500 text-center">Giỏ hàng trống</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>