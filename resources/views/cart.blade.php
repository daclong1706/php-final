<x-app-layout>
    <div class="pt-20 pb-6 bg-gradient-to-r from-indigo-900 to-blue-900 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Giỏ hàng của bạn</h1>
            <p class="text-blue-100 max-w-2xl">Xem lại các khóa học bạn đã chọn và tiến hành thanh toán</p>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-xl border border-gray-100">
                <div class="p-6">
                    @if($cartItems->count())
                        <div class="space-y-6">
                            @foreach($cartItems as $item)
                                <div class="flex flex-col md:flex-row md:justify-between md:items-center py-6 border-b border-gray-100 gap-4">
                                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                                        @if($item->course->coursedetails[0]->content)
                                            @php
                                                $videoId = '';
                                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $item->course->coursedetails[0]->content, $match)) {
                                                    $videoId = $match[1];
                                                }
                                            @endphp
                                            <div class="relative w-full md:w-auto">
                                                <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" 
                                                    alt="{{ $item->course->name }}"
                                                    class="w-full md:w-32 h-auto md:h-24 object-cover rounded-lg shadow-sm">
   
                                            </div>
                                        @else
                                            <div class="w-full md:w-32 h-24 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $item->course->name }}</h3>
                                            <div class="flex items-center mt-1">
                                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">
                                                    {{ $item->course->subject }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-600">Lớp {{ $item->course->grade }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between md:justify-end w-full md:w-auto gap-4">
                                        <span class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">
                                            {{ number_format($item->course->price) }} VND
                                        </span>
                                        <form action="{{ route('cart.remove', $item->course) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8 border-t border-gray-100 pt-8">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <p class="text-gray-600">Tổng số khóa học: <span class="font-semibold">{{ $cartItems->count() }}</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600 mb-1">Tổng thanh toán:</p>
                                    <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">
                                        {{ number_format($total) }} VND
                                    </p>
                                </div>
                            </div>
                            
                            <form action="{{ route('vnpay.create-payment') }}" method="POST" class="mt-6">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $total }}">
                                <input type="hidden" name="language" value="vn">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                    <a href="{{ route('category.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Tiếp tục mua sắm
                                    </a>
                                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-medium rounded-full shadow-md transition-colors duration-200">
                                        Thanh toán ngay
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-12">
                            <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-gray-800 mb-2">Giỏ hàng của bạn đang trống</h3>
                            <p class="text-gray-600 text-center max-w-md mb-6">Bạn chưa thêm khóa học nào vào giỏ hàng. Hãy khám phá các khóa học của chúng tôi và thêm vào giỏ hàng.</p>
                            <a href="{{ route('category.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-full hover:from-indigo-700 hover:to-blue-700 transition duration-200 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Khám phá khóa học
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
