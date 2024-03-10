<x-guest-layout>
    <section class="overflow-hidden lg:mx-10 bg-white py-8 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
            <div class="lg:pr-8 lg:pt-4">
              <div class="lg:max-w-lg">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Event faster</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$event->title}}</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">{{$event->description}}
                </p>
                <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
                  <div class="relative pl-9">
                    <dt class="inline font-semibold text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" class="absolute left-1 top-1 h-5 w-5 text-indigo-600">
                        <path
                          d="M3.196 12.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 12.87z">
                        </path>
                        <path
                          d="M3.196 8.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 8.87z">
                        </path>
                        <path
                          d="M10.38 1.103a.75.75 0 00-.76 0l-7.25 4.25a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.76 0l7.25-4.25a.75.75 0 000-1.294l-7.25-4.25z">
                        </path>
                      </svg>Template driven
                    </dt>
                    <dd class="inline">Inspired by Sendgrid, Mailchimp, and Postmark, we allow you to create and apply
                      templated content to your media.
                    </dd>
                  </div>
                  <div class="relative pl-9">
                    <dt class="inline font-semibold text-gray-900">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                        class="absolute left-1 top-1 h-5 w-5 text-indigo-600">
                        <path fill-rule="evenodd"
                          d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z"
                          clip-rule="evenodd"></path>
                      </svg>
                      Simple, REST
                    </dt>
                    <dd class="inline">A simple REST API that allows you to create, generate, and manage your content.</dd>
                  </div>
                  <div class="relative pl-9">
                    <dt class="inline font-semibold text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" class="absolute left-1 top-1 h-5 w-5 text-indigo-600">
                        <path fill-rule="evenodd"
                          d="M14.5 10a4.5 4.5 0 004.284-5.882c-.105-.324-.51-.391-.752-.15L15.34 6.66a.454.454 0 01-.493.11 3.01 3.01 0 01-1.618-1.616.455.455 0 01.11-.494l2.694-2.692c.24-.241.174-.647-.15-.752a4.5 4.5 0 00-5.873 4.575c.055.873-.128 1.808-.8 2.368l-7.23 6.024a2.724 2.724 0 103.837 3.837l6.024-7.23c.56-.672 1.495-.855 2.368-.8.096.007.193.01.291.01zM5 16a1 1 0 11-2 0 1 1 0 012 0z"
                          clip-rule="evenodd"></path>
                        <path
                          d="M14.5 11.5c.173 0 .345-.007.514-.022l3.754 3.754a2.5 2.5 0 01-3.536 3.536l-4.41-4.41 2.172-2.607c.052-.063.147-.138.342-.196.202-.06.469-.087.777-.067.128.008.257.012.387.012zM6 4.586l2.33 2.33a.452.452 0 01-.08.09L6.8 8.214 4.586 6H3.309a.5.5 0 01-.447-.276l-1.7-3.402a.5.5 0 01.093-.577l.49-.49a.5.5 0 01.577-.094l3.402 1.7A.5.5 0 016 3.31v1.277z">
                        </path>
                      </svg>Developer friendly </dt>
                    <dd class="inline">Documented and easy to use, we make it easy to integrate with your existing workflow.
                    </dd>
                  </div>
                </dl>
              </div>
              <div class="mt-10 flex items-center gap-x-6">
                <form method="post" class="flex gap-1 " action="{{ route('getReservation', $event->id) }}">
                    @csrf
                <button  
                  class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Order

                </button>
                <div class="relative flex items-center max-w-[8rem]">
                    <button type="button" id="decrement-button"
                        data-input-counter-decrement="quantity-input{{ $event->id }}"
                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h16" />
                        </svg>
                    </button>
                    <input max="4" min="1" name="numberOfTicket" value="1" type="number" id="quantity-input{{ $event->id }}" data-input-counter
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="2" required />
                    <button type="button" id="increment-button"
                        data-input-counter-increment="quantity-input{{ $event->id }}"
                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </button>
                </div>
                </form>
              </div>
            </div><img src="{{asset("uploads/events/{$event->image}")}}" alt="Product screenshot" class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0" width="2432" height="1442">
          </div>
        </div>
      </section>
</x-guest-layout>
