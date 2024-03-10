<div class="flex p-4 lg:px-10 flex-col md:flex-row gap-3">
    <div class="flex w-full ">
        <input type="text" id="search_input" placeholder="Search for the tool you like"
            class="w-full  px-3 h-10 rounded-l border-2 border-blue-500 focus:outline-none focus:border-blue-500"
            >
        <button type="submit" class="bg-blue-500 text-white rounded-r px-2 md:px-3 py-0 md:py-1">Search</button>
    </div>
    <select id="category" name="category"
        class="w-3/12 h-10 border-2 border-blue-500 focus:outline-none focus:border-blue-500 text-blue-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
        <option value="0" selected>All Categories</option>

        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>

        @endforeach

    </select>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <div class="text-center ">

        <input id="startDate" class="border-2 border-gray-300 rounded px-3 py-2 w-48" type="text"
            placeholder="start  date">
    </div>
    <div class="text-center ">

        <input id="endDate" class="border-2 border-gray-300 rounded px-3 py-2 w-48" type="text"
            placeholder="end date">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#startDate", {
            // Configuration options for Flatpickr
            // You can customize the appearance and behavior here
        });
        flatpickr("#endDate", {
            // Configuration options for Flatpickr
            // You can customize the appearance and behavior here
        });
    </script>
</div>
