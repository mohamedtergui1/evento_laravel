<x-guest-layout>
    <x-search :categories="$categories" />
    <div id="place_result" class=" py-10 flex flex-wrap items-center justify-start">


        @foreach ($events as $event)
            <div
                class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2 w-full max-w-sm rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
                <img src="https://readymadeui.com/cardImg.webp" class="w-full rounded-lg" />
                <div class="px-4 my-6 text-center">
                    <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                    <p class="mt-2 text-sm text-gray-400">{{ $event->description }}</p>

                </div>
                <div class="flex justify-between  items-center ">
                    <span>{{ substr($event->date, 0, 16) }}</span> <span
                        class="px-2 py-1 border rounded-sm">{{ $event->category->name }}</span>
                </div>
                <div class="space-x-10 flex items-center justify-end  pt-4 ">
                    <span>{{ $event->user->name }}</span>
                    <div class="relative  ">
                        <img src="https://readymadeui.com/team-6.webp" class="w-14 h-14 rounded-full" />
                        <span
                            class="h-3 w-3 rounded-full border border-white bg-green-500 block absolute bottom-1 right-0"></span>
                    </div>


                </div>
                <div class="mt-4 flex items-center flex-wrap gap-4">
                    <h3 class="text-xl text-[#333] font-bold flex-1">$ {{ $event->price }}</h3>
                    <button type="button"
                        class="px-6 py-2.5 rounded text-[#333] text-sm tracking-wider font-semibold border-2 border-[#333] hover:bg-gray-50 outline-none">Order
                        now</button>
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
    </div>
</x-guest-layout>
