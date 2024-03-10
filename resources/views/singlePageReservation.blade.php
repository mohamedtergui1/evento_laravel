<x-guest-layout>
    <x-alert />
     <div class="text-center py-10 text-3xl" > manage event reservation</div>
    <x-table-reservation class="py-10 shadow-md"  :reservations="$reservation" />
</x-guest-layout>
