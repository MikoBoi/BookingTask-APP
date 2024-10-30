<x-layout>
    <x-slot:heading>
        Доступные события
    </x-slot:heading>

    <ul role="list" class="divide-y divide-gray-200">

        @foreach($events as $event)

            <li class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <div class="w-64 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">{{$event['event_name']}}</p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{$event['event_description']}}</p>
                    </div>
                </div>

                <div class="flex min-w-0 gap-x-4 items-center">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">Дата и время: {{$event['event_date']}}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <a href="/events/{{$event['id']}}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Подробнее</a>
                </div>
            </li>

        @endforeach

    </ul>

</x-layout>