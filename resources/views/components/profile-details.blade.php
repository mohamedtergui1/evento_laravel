<div class="w-96  lg:w-1/3  h-96 bg-gray-100 px-10 pt-10">
    <div class="relative mt-16 mb-32 max-w-sm mx-auto  ">
        <div class="rounded overflow-hidden shadow-md bg-white">
            <div class="absolute -mt-20 w-full flex justify-center">
                <div class="h-32 w-32">
                    <img src="{{asset("uploads/users/".auth()->user()->image)}}"
                        class="rounded-full object-cover h-full w-full shadow-md" />
                </div>
            </div>
            <div class="px-6 mt-16">
                <h1 class="font-bold text-3xl text-center mb-1">{{ auth()->user()->name }}</h1>
                <p class="text-gray-800 text-sm text-center">Chief Executive Officer</p>
                <p class="text-center text-gray-600 text-base pt-3 font-normal">
                    Carole Steward is a visionary CEO known for her exceptional leadership and strategic
                    acumen.
                    With a
                    wealth of experience in the corporate world, she has a proven track record of driving
                    innovation and
                    achieving remarkable business growth.
                </p>
                <div class="w-full flex justify-center pt-5 pb-5">
                    <a href="#" class="mx-5">
                        <div aria-label="Github">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-github">
                                <path
                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                </path>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="mx-5">
                        <div aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                </path>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="mx-5">
                        <div aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white lg:w-1/3 w-96 h-96 overflow-hidden shadow rounded-lg border">
    <div class="px-4 py-5 flex gap-5 justify-end sm:px-6">
        <form method="post" action="{{route("changeRole")}}">
            @csrf
            @method("PUT")
            <button  class="bg-blue-500 px-2 py-1 rounded-md text-white" >
                @role("user")
                    Mode Organizer
                @else
                Mode User
                @endrole
            </button>
        </form>
        <a href="{{ route('profile.edit') }}">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2"
                    d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.1 1.9-.7-.7m5.6 5.6-.7-.7m-4.2 0-.7.7m5.6-5.6-.7.7M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </a>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Full name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ auth()->user()->name }}
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Email address
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ auth()->user()->email }}
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Phone number
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    (123) 456-7890
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Address
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    123 Main St<br>
                    Anytown, USA 12345
                </dd>
            </div>
        </dl>
    </div>
</div>
