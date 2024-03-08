@foreach ($events as $event)
<div
    class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2    w-96 rounded-lg font-[sans-serif] overflow-hidden m-2 mt-4">
    <img src="https://readymadeui.com/cardImg.webp" class="w-full rounded-lg" />
    <div class="px-4 my-6 text-center">
        <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
        <p class="mt-2 text-sm text-gray-400">{{ $event->description }}</p>

    </div>
    <div class="flex justify-between  items-center ">
        <span>{{ \Carbon\Carbon::parse($event->date)->format('Y-F-d h:m') }}</span> <span
            class="px-2 py-1 border rounded-sm">{{ $event->category->name }}</span>
    </div>
    <div class="space-x-10 flex items-center justify-end  pt-4 ">
        <span>{{ $event->user->name }}</span>
        <div class="relative  ">
            <img src="https://readymadeui.com/team-6.webp" class="w-14 h-14 rounded-full" />
            <span class="h-3 w-3 rounded-full border border-white bg-green-500 block absolute bottom-1 right-0"></span>
        </div>


    </div>
    <div class="mt-4 flex items-center flex-wrap gap-4">
        <h3 class="text-xl text-[#333] font-bold flex-1">$ {{ $event->price }}</h3>
        <form method="post" class="flex gap-1 " action="{{ route('getReservation', $event->id) }}">
            @csrf
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
                    <input name="numberOfTicket" value="1" type="text" id="quantity-input{{ $event->id }}" data-input-counter
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="2" required />
                    <button type="button" id="increment-button"
                        data-input-counter-increment="quantity-input{{ $event->id }}"
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
@endforeach
@if (count($events) == 0)
    <div class="flex p-5 pb-10 justify-end">
        <p class=" text-red-700 text-center text-3xl ">
            its empty
        </p>
    </div>
@else
    <div class="flex p-5 pb-10 justify-end">
        {{ $events->links() }}
    </div>
@endif
