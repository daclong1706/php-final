<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($course->video_url)
                    <div class="aspect-w-16 aspect-h-9 mb-6">
                        @php
                        $videoId = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $course->video_url, $match)) {
                        $videoId = $match[1];
                        }
                        @endphp
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-full aspect-video mb-4"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Chi tiết khóa học</h3>
                            <p><span class="font-medium">Khóa học :</span>{{ $course->category->name }}</p>
                            <p><span class="font-medium">Lớp:</span> {{ $course->grade }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold">{{ number_format($course->price) }} VND</p>
                            @auth
                            @if(!auth()->user()->courses->contains($course->id))
                            <form action="{{ route('cart.add', $course) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                            @else
                            <span class="mt-4 inline-block bg-green-500 text-white font-bold py-2 px-4 rounded">
                                Học thôi nào
                            </span>
                            @endif
                            @else
                            <a href="{{ route('login') }}"
                                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Đăng nhập để đăng ký
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>