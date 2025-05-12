@props(['course'])

<div {{ $attributes->merge(['class' => 'border rounded-lg p-4 hover:shadow-lg transition-shadow']) }}>
    <a href="{{ route('course.show', $course->id) }}">
        @if($course->video_url)
        @if(str_contains($course->video_url, 'youtube.com') || str_contains($course->video_url, 'youtu.be'))
        @php
        $videoId = '';
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $course->video_url, $match)) {
        $videoId = $match[1];
        }
        @endphp
        <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
            alt="{{ $course->name }}"
            class="w-full h-48 object-cover rounded-lg mb-4">
        @elseif(str_contains($course->video_url, 'rumble.com'))
        {{-- Rumble thumbnail URL structure may vary, you might need to adjust this --}}
        <img src="https://rumble.com/embed/{{ $videoId }}/thumbnail.jpg"
            alt="{{ $course->name }}"
            class="w-full h-48 object-cover rounded-lg mb-4">
        @endif
        @endif
    </a>

    <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
    <p class="text-gray-600">{{ __('Subject') }}: {{ $course->category->name }}</p>
    <p class="text-gray-600">{{ __('Grade') }}: {{ $course->grade }}</p>
    <p class="text-gray-800 font-bold mt-2">{{ number_format($course->price) }} VND</p>
</div>