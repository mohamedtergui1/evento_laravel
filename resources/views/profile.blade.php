<x-guest-layout>
    <div class="flex gap-5 justify-center py-10 flex-wrap">


        <x-profile-details />

    </div>

    <x-alert />
    
     <x-table-events-in-profile   :events="$events" />



    <x-modal-create-event :categories="$categories" />



    <x-table-myreservation-in-profile :myReservation="$myReservation" />


</x-guest-layout>
