<!-- @foreach($courses as $courseUser)
<p>{{ $courseUser->course->name }}</p> of <p>{{ $courseUser->user->name }}</p>
@endforeach -->
<h2 class="text-xl font-semibold mb-4">Khóa học của tôi</h2>

@forelse ($courses as $courseUser)
<div class="p-4 border rounded mb-2">
    <h3 class="text-lg font-medium">
        {{ $courseUser->course->name ?? 'Không có tên khóa học' }}
    </h3>
    <h5 class="text-lg font-medium">
        {{ $courseUser->course->category->name ?? 'Không có tên môn học' }}
    </h5>
    <p>Giá: {{ number_format($courseUser->course->price, 0, ',', '.') }} VND</p>
</div>
@empty
<p>Bạn chưa đăng ký khóa học nào.</p>
@endforelse
