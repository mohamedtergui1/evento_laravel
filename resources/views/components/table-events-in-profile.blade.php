<div  class="pt-20 flex justify-center  text-center text-3xl" >
    <h2> manage your events </h2>
</div>

<div class="px-2 ">
    <div class="flex justify-end p-5">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="ml-2 px-4 py-2 font-medium text-white bg-sky-600 rounded-md hover:bg-sky-500 focus:outline-none focus:shadow-outline-sky active:bg-sky-600 transition duration-150 ease-in-out">Add</button>
    </div>
    <div class="overflow-x-scroll">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        title
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        capacity
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">rest
                        places
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        location
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        price
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">auto
                        akcept
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        catrgory
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->capacity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->rest_places }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($event->status == 'accepted')
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">accepted</span>
                            @endif
                            @if ($event->status == 'rejected')
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">rejected</span>
                            @endif
                            @if ($event->status == 'pending')
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($event->autoAccept)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">yes</span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">no</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->category->name }}</td>
                        <td class="px-6 py-4 flex justify-around">
                            <a href="{{ route('eventReservation', $event->id) }}"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">show</a>
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Edit</a>
                            <form class="flex" action="{{ route('events.destroy', $event->id) }}"
                                method="post">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confurmDelete(event)" type="submit"
                                    class="deleteEventBTN ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</button>
                            </form>


                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>
