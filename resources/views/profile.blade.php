<x-guest-layout>
    <x-alert />
    <div class="flex gap-5 justify-center pb-36 flex-wrap">


        <x-profile-details />

    </div>



 @role("organizer")
            <div  class="px-10 " >
                <x-UserStatistic :events="$events" />
            </div>
    <x-table-events-in-profile :events="$events" />
    <x-modal-create-event :categories="$categories" />


@else


    <x-table-myreservation-in-profile :myReservation="$myReservation" />

@endrole

</x-guest-layout>
