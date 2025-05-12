@foreach ($courses as $course)
<div class="p-6 bg-white border-b border-gray-200">
    <x-course.course-card :course="$course" />
</div>
@endforeach