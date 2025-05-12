<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 gap-4 ">
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
