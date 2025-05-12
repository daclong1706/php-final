<x-app-layout>
    <h1>Danh sách danh mục</h1>

    <form action="{{ route('category.filter') }}" method="GET" class="flex justify-between mx-12 mt-6 items-center">
        <ul class="flex w-full gap-2">
            <li>
                <input type="checkbox" name="categories[]" value="" id="all-option" class="hidden peer" {{ empty($selectedCategories) ? 'checked' : '' }}>
                <label for="all-option" class="inline-flex items-center justify-between w-full px-5 py-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:text-indigo-600 peer-checked:bg-indigo-200/50">
                    <div class="block">
                        <div class="w-full font-semibold">Tất cả</div>
                    </div>
                </label>
            </li>

            @foreach ($categories as $cat)
            <li>
                <input type="checkbox" name="categories[]" value="{{ $cat->id }}" id="category-{{ $cat->id }}" class="hidden peer" {{ in_array($cat->id, $selectedCategories ?? []) ? 'checked' : '' }}>
                <label for="category-{{ $cat->id }}" class="inline-flex items-center justify-between w-full px-5 py-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:text-indigo-600 peer-checked:bg-indigo-200/50">
                    <div class="block">
                        <div class="w-full font-semibold">{{ $cat->name }}</div>
                    </div>
                </label>
            </li>
            @endforeach
        </ul>

        <div class="flex items-center gap-4 mr-4">
            <label for="min-price" class="text-gray-600 font-semibold">Giá</label>
            <input type="number" name="min_price" id="min-price" class="border border-gray-300 rounded-lg px-2 py-1" placeholder="0" value="{{ request('min_price') }}">

            <label for="max-price" class="text-gray-600 font-semibold">-</label>
            <input type="number" name="max_price" id="max-price" class="border border-gray-300 rounded-lg px-2 py-1" placeholder="10000000" value="{{ request('max_price') }}">
        </div>


        <button type="submit" class="focus:outline-none text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 flex gap-2 items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
            Lọc
        </button>
    </form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex w-full justify-end mt-6 pr-12 relative">
                    <input type="text" id="search" placeholder="Tìm kiếm khóa học..." class="w-1/2 md:w-1/3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-6 py-2" id="courses-list">
                    @include('components.course.course-card-list', ['courses' => $courses])
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectAll = document.getElementById("all-option");
        let checkboxes = document.querySelectorAll("input[name='categories[]']");

        selectAll.addEventListener("change", function() {
            if (this.checked) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
            }
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                if (this.checked) {
                    selectAll.checked = false;
                }

                let allUnchecked = [...checkboxes].every(checkbox => !checkbox.checked);
                selectAll.checked = allUnchecked;
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let searchInput = document.getElementById("search");

        function fetchSearchResults() {
            let query = searchInput.value;

            fetch(`/courses/search?query=${query}`)
                .then(response => response.text())
                .then(html => {
                    let coursesContainer = document.getElementById("courses-list");
                    coursesContainer.innerHTML = html;
                });
        }

        searchInput.addEventListener("keyup", fetchSearchResults);
    });
</script>