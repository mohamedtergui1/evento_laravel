
    <h3 class="text-center text-5xl  mb-10  font-bold   "  >Statistic</h3>

    <h3 class="text-center text-3xl  mb-10  font-bold   "  >event with  number of reservation</h3>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        event
                    </th>
                    <th scope="col" class="px-6 py-3">
                        price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        count reservation
                    </th>


                </tr>
            </thead>

            <tbody>
                @foreach ($events as $event)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$event->title}}
                        </th>
                        <td class="px-6 py-4">
                            {{$event->price}}
                        </td>
                        <td class="px-6 py-4">
                            {{count($event->reservations)}}
                        </td>

                    </tr>
                @endforeach

                @if (count($events) == 0)
                <tr>
                    <td   class="text-red-500 text-xl  text-center py-10" > no   reservation </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
