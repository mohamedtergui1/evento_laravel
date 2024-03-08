<x-guest-layout>
    <x-search :categories="$categories" />
    <x-alert/>
    <div id="place_result" class=" py-10 px-5 lg:px-12 flex flex-wrap items-center justify-start">



            <x-card-event :events="$events"/>


            </div>

    </div>
</x-guest-layout>
