<x-layout>
    <x-slot:heading>
        Событие: {{ $event['event_name'] }}
    </x-slot:heading>

    <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event['id'] }}">

        <div class="ticket-type flex space-x-3 items-center">
            <label class="w-48">Купить взрослый билет:</label>
            <button type="button" class="decrement flex justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" data-type="adult">x</button>
            <button type="button" class="increment flex justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600" data-type="adult">Купить</button>
            <input type="text" class="w-16 bg-gray-100" name="ticket_adult_quantity" value="0" readonly>
        </div>

        <br>

        <div class="ticket-type flex space-x-3 items-center">
            <label class="w-48">Купить детский билет:</label>
            <button type="button" class="decrement flex justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" data-type="kid">x</button>
            <button type="button" class="increment flex justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600" data-type="kid">Купить</button>
            <input type="text" class="w-16 bg-gray-100" name="ticket_kid_quantity" value="0" readonly>
        </div>

        <br>

        <div class="ticket-type flex space-x-3 items-center">
            <label class="w-48">Купить льготный билет:</label>
            <button type="button" class="decrement flex justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" data-type="discount">x</button>
            <button type="button" class="increment flex justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600" data-type="discount">Купить</button>
            <input type="text" class="w-16 bg-gray-100" name="ticket_discount_quantity" value="0" readonly>
        </div>

        <br>

        <div class="ticket-type flex space-x-3 items-center">
            <label class="w-48">Купить групповой билет:</label>
            <button type="button" class="decrement flex justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" data-type="group">x</button>
            <button type="button" class="increment flex justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600" data-type="group">Купить</button>
            <input type="text" class="w-16 bg-gray-100" name="ticket_group_quantity" value="0" readonly>
        </div>

        <br>

        <button type="submit" class="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Купить</button>
    </form>

    <br>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".increment").click(function() {
            let type = $(this).data("type");
            let input = $("input[name=" + "ticket_" + type + "_quantity]");
            let currentValue = parseInt(input.val());
            input.val(currentValue + 1);
        });

        $(".decrement").click(function() {
            let type = $(this).data("type");
            let input = $("input[name=" + "ticket_" + type + "_quantity]");
            let currentValue = parseInt(input.val());
            if (currentValue > 0) {
                input.val(currentValue - 1);
            }
        });
    });
</script>