<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
                    @foreach ($courses as $course)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <x-course.course-card :course="$course" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>