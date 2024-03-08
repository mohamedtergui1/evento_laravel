<div  class="pt-20 flex justify-center  text-center text-3xl" >
    <h2> manage your reservation </h2>
</div>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   event title
                </th>
                <th scope="col" class="px-6 py-3">
                    number of ticket
                </th>
                <th scope="col" class="px-6 py-3">
                    event price
                </th>
                <th scope="col" class="px-6 py-3">
                    total price
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
            @foreach ($myReservation as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$reservation->event->title}}
                            </th>
                            <td class="px-6 py-4">
                                {{$reservation->numberOfTicket}}
                            </td>
                            <td class="px-6 py-4">
                             $   {{$reservation->event->price}}
                            </td>
                            <td class="px-6 py-4">
                              $  {{$reservation->event->price * $reservation->numberOfTicket}}
                            </td>
                            <td class="px-6 py-4">
                                {{$reservation->status}}
                            </td>
                            <td class="  flex justify-start gap-1 px-6 py-4">
                                    @if($reservation->status == "accepted")
                                        <form action="">
                                            <button  class="px-2 py-1 rounded-md text-white  bg-blue-500" >checkout</button>
                                        </form>
                                    @else

                                    <button disabled  class="px-2 py-1 rounded-md text-white bg-blue-800" >checkout</button>
                                    @endif

                            </td>
                        </tr>
            @endforeach


        </tbody>
    </table>
</div>
