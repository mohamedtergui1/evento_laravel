

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   user name
                </th>
                <th scope="col" class="px-6 py-3">
                    number of ticket
                </th>
                <th scope="col" class="px-6 py-3">
                    status
                </th>
                <th scope="col" class="px-6 py-3">
                    action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$reservation->user->name}}
                            </th>
                            <td class="px-6 py-4">
                                {{$reservation->numberOfTicket}}
                            </td>
                            <td class="px-6 py-4">
                                {{$reservation->status}}
                            </td>
                            <td class="  flex justify-start gap-1 px-6 py-4">
                                @if ($reservation->status=="pending")
                                            <form method="POST" action="{{route("chnageReservationStatus",$reservation->id)}}">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden"  name="status" value="accepted" >
                                                <button class="px-2 py-1 rounded text-white bg-blue-500" >
                                                    accepte
                                                </button>
                                            </form>
                                            <form method="POST" action="{{route("chnageReservationStatus",$reservation->id)}}">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden"  name="status" value="rejected" >

                                                <button  class="px-2 py-1 text-white rounded bg-red-500" >rejecte</button>

                                            </form>

                                @endif

                            </td>
                        </tr>
            @endforeach


        </tbody>
    </table>
</div>
