function confurmDelete(e) {
    e.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.closest("form").submit();
        }
    });
}

function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById("image-preview");

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = "block";
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function () {
    var current_page = 1;
    const loader = ` <div class="rounded-lg p-4 bg-gray-200 animate-pulse block  w-96  loaderCart ">
    <div class="  bg-gray-300 h-44 w-full"></div>
    <div class="flex space-x-4 py-6">

        <div class="flex-1 space-y-4 h-60 py-1">
            <div class="h-4 bg-gray-300 rounded w-3/4"></div>
            <div class="space-y-2">
                <div class="h-4 bg-gray-300 rounded"></div>
                <div class="h-4 bg-gray-300 rounded w-5/6"></div>
            </div>
            <div class="space-y-2">
                <div class="h-4 bg-gray-300 rounded"></div>
                <div class="h-4 bg-gray-300 rounded w-5/6"></div>
            </div>
            <div class="space-y-2">
                <div class="h-4 bg-gray-300 rounded"></div>
                <div class="h-4 bg-gray-300 rounded w-5/6"></div>
            </div>
            <div class="space-y-2">
                <div class="h-4 bg-gray-300 rounded"></div>
                <div class="h-4 bg-gray-300 rounded w-5/6"></div>
            </div>
        </div>
    </div>
</div>`;

    function sholoadersearch() {
        for (let i = 0; i < 6; i++) $("#place_result").append(loader);
    }
    function hideLoaders() {
        $(".loaderCart").each(function (index) {
            $(this).remove();
        });
    }

    document
        .getElementById("search_input")
        .addEventListener("input", fetchData);
    document.getElementById("category").addEventListener("change", fetchData);

    function fetchData() {
        var search_string = document.getElementById("search_input").value;
        var category = document.getElementById("category").value;
        var endDate = document.getElementById("endDate").value;
        var startDate = document.getElementById("startDate").value;

        var token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        var params = new URLSearchParams({
            search_string: search_string,
            category: category,
            startDate: startDate,
            endDate: endDate,
        }).toString();
        $("#place_result").html("");
        sholoadersearch();
        fetch("/search?" + params, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                console.log(data);
                if (data.status) {
                    $("#place_result").html("");
                    showEvent(data.events.data, data.token);
                    current_page = data.events.current_page;
                } else noResult();
                hideLoaders();
            })
            .catch((error) => {
                console.error("Fetch Error:", error);
            });
    }
    function moreData() {
        var search_string = document.getElementById("search_input").value;
        var category = document.getElementById("category").value;
        var endDate = document.getElementById("endDate").value;
        var startDate = document.getElementById("startDate").value;
        var token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        page = current_page;
        var params = new URLSearchParams({
            search_string: search_string,
            category: category,
            startDate: startDate,
            endDate: endDate,
            page: current_page,
        }).toString();
        sholoadersearch();
        fetch("/search?" + params, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                console.log(data);
                if (data.status) {
                    showEvent(data.events.data, data.token);
                    current_page++;
                    console.log(current_page);
                }
                hideLoaders();
            })
            .catch((error) => {
                console.error("Fetch Error:", error);
            });
    }

    function noResult() {
        $("#place_result").html(`
            <div class="w-full flex justify-center" >
                <img src="https://cdn.dribbble.com/users/235730/screenshots/2936116/no-resultfound.jpg" alt="">
            </div>
        `);
    }
    window.addEventListener("scroll", function () {
        var scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

        var totalHeight = document.documentElement.scrollHeight;

        var windowHeight = window.innerHeight;

        var distanceToBottom = totalHeight - (scrollTop + windowHeight);

        if (distanceToBottom < 50) {
            moreData(current_page + 1);
        }
    });
    function showEvent(events, token) {
        events.forEach((event, i) => {
            var description = limitString(event.description, 80);
            var title = limitString(event.title, 20);

            $("#place_result").append(`


            <div

            class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2    w-96 rounded-lg font-[sans-serif] overflow-hidden m-2 mt-4">
            <img src="http://127.0.0.1:8000/uploads/events/${event.image}" class="w-full h-56 rounded-lg" />

            <div class="px-4 my-6 text-center">
                <h3 class="text-lg font-semibold">${title}</h3>
                <p class="mt-2 text-sm text-gray-400">${description}</p>

            </div>
            <div class="flex justify-between  items-center ">
                <span>${event.date}</span> <span
                    class="px-2 py-1 border rounded-sm">${event.category.name}</span>
            </div>
            <div class="space-x-10 flex items-center justify-end  pt-4 ">
                <span>${event.user.name}</span>
                <div class="relative  ">
                    <img src="https://readymadeui.com/team-6.webp" class="w-14 h-14 rounded-full" />
                    <span class="h-3 w-3 rounded-full border border-white bg-green-500 block absolute bottom-1 right-0"></span>
                </div>


            </div>
            <div class="mt-4 flex items-center flex-wrap gap-4">
                <h3 class="text-xl text-[#333] font-bold flex-1">$ ${ event.price }</h3>

                <form method="post" class="flex gap-1 " action="{{ route('getReservation', $event->id) }}">
                      <input name="_token" value="${token}" type="hidden">
                    <div class="w-32">
                        <div class="relative flex items-center max-w-[8rem]">
                            <button type="button" id="decrement-button"
                                data-input-counter-decrement="quantity-input{{ $event->id }}"
                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 1h16" />
                                </svg>
                            </button>
                            <input max="4" min="1" name="numberOfTicket" value="1" type="number" id="quantity-input${event.id}" data-input-counter
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="2" required />
                            <button type="button" id="increment-button"
                                data-input-counter-increment="quantity-input${event.id}"
                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 1v16M1 9h16" />
                                </svg>
                            </button>
                        </div>

                    </div>

                         <button
                        class="px-6 py-2.5 rounded text-[#333] text-sm tracking-wider font-semibold border-2 border-[#333] hover:bg-gray-50 outline-none">Order
                        now</button>


                </form>

            </div>

            <button type="button"
                class="px-6 py-2 w-full mt-4 rounded-lg text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">View</button>

        </div>


                `);

                function limitString(str, maxLength, suffix = '...') {
                    if (str.length <= maxLength) {
                        return str;
                    }
                    return str.substring(0, maxLength) + suffix;
                }
        });
    }
});
