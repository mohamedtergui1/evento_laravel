function confurmDelete(e) {
    e.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            e.target.closest('form').submit();
        }
    });
}
$(document).ready(function () {
    document.getElementById('search_input').addEventListener('input', fetchData);
    document.getElementById('category').addEventListener('change', fetchData);

    function fetchData() {
        var search_string = document.getElementById('search_input').value;
        var category = document.getElementById('category').value;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var params = new URLSearchParams({
            search_string: search_string,
            category: category
        }).toString();
        searchLoading()
        fetch('/search?' + params, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => {

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.events)
                if (data.status) {
                    showProduct(data.events, data.token);
                } else noResult();
            })
            .catch(error => {
                console.error('Fetch Error:', error);
            });
    }

    function searchLoading() {
        $("#place_result").html(`
            <div aria-label="Loading..." role="status" class="flex items-center space-x-2">
            <svg class="h-20 w-20 animate-spin stroke-gray-500" viewBox="0 0 256 256">
                <line x1="128" y1="32" x2="128" y2="64" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <line x1="195.9" y1="60.1" x2="173.3" y2="82.7" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="224" y1="128" x2="192" y2="128" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
                <line x1="195.9" y1="195.9" x2="173.3" y2="173.3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="128" y1="224" x2="128" y2="192" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
                <line x1="60.1" y1="195.9" x2="82.7" y2="173.3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="32" y1="128" x2="64" y2="128" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <line x1="60.1" y1="60.1" x2="82.7" y2="82.7" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
            </svg>
            <span class="text-4xl font-medium text-gray-500">Loading...</span>
        </div>
            `)
    }
    function noResult() {
        $("#place_result").html(`
            <div class="w-full flex justify-center" >
                <img src="https://cdn.dribbble.com/users/235730/screenshots/2936116/no-resultfound.jpg" alt="">
            </div>
        `)
    }

    function showProduct(events, token) {
        $("#place_result").html("")
        events.forEach(event => {
            $("#place_result").append(`
                <div
                class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2 w-full max-w-sm rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
                <img src="https://readymadeui.com/cardImg.webp" class="w-full rounded-lg" />
                <div class="px-4 my-6 text-center">
                    <h3 class="text-lg font-semibold">${event.name}</h3>
                    <p class="mt-2 text-sm text-gray-400">${event.description}</p>

                </div>
                <div class="flex justify-between  items-center ">
                    <span>${event.date} </span> <span
                        class="px-2 py-1 border rounded-sm">${event.category.name}</span>
                </div>
                <div class="space-x-10 flex items-center justify-end  pt-4 ">
                    <span>${event.user.name}</span>
                    <div class="relative  ">
                        <img src="https://readymadeui.com/team-6.webp" class="w-14 h-14 rounded-full" />
                        <span
                            class="h-3 w-3 rounded-full border border-white bg-green-500 block absolute bottom-1 right-0"></span>
                    </div>


                </div>
                <div class="mt-4 flex items-center flex-wrap gap-4">
                    <h3 class="text-xl text-[#333] font-bold flex-1">$ ${event.price}</h3>
                    <button type="button"
                        class="px-6 py-2.5 rounded text-[#333] text-sm tracking-wider font-semibold border-2 border-[#333] hover:bg-gray-50 outline-none">Order
                        now</button>
                </div>

                <button type="button"
                    class="px-6 py-2 w-full mt-4 rounded-lg text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">View</button>
            </div>
                `);


        });
    }


});
