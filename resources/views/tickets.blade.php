<x-layout>
    <x-slot:heading>
        Купленые вами билеты
    </x-slot:heading>

    @if ($ticketCollection->isEmpty())
        <h1>Вы не покупали билеты :(</h1>
    @endif

    <ul role="list" class="space-y-3">

        @foreach($ticketCollection as $index => $ticketCollectionItem)

            <li class="w-96 justify-between gap-x-6 py-5 px-5 bg-white rounded-lg space-y-5">
                <p class="text-sm font-semibold leading-6 text-gray-900"><strong>ID заказа: </strong>{{$ticketCollectionItem['id']}}</p>
                
                @foreach($ticketCollectionItem['Tickets'][$index] as $ticketItem)
                <div class="flex min-w-0 gap-x-4">
                    <div class="w-64 flex-auto bg-gray-100 rounded-lg py-2 px-2">
                        <p class="text-sm font-semibold leading-6 text-gray-900"><strong>ID билета: </strong>{{$ticketItem['id']}}</p>
                        <p class="text-sm font-semibold leading-6 text-gray-900"><strong>Тип билета: </strong>{{$ticketItem['ticket_type']}}</p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500"><strong>Штрих-код билета: </strong>{{$ticketItem['barcode']}}</p>
                    </div>
                </div>
                @endforeach
                <p class="text-sm font-semibold leading-6 text-gray-900"><strong>Общая стоимость: </strong>${{$ticketCollectionItem['equal_price']}}</p>
            </li>

        @endforeach

    </ul>

</x-layout>