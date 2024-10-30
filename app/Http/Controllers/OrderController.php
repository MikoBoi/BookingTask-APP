<?php

namespace App\Http\Controllers;

use App\Models\Event as ModelsEvent;
use Illuminate\Http\Request;

use App\Services\OrderService;

use App\Models\Event;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'event_id' => 'required|integer',
            'ticket_adult_quantity' => 'nullable|integer|min:0',
            'ticket_kid_quantity' => 'nullable|integer|min:0',
            'ticket_discount_quantity' => 'nullable|integer|min:0',
            'ticket_group_quantity' => 'nullable|integer|min:0',
        ]);

        if (
            ($request->input('ticket_adult_quantity', 0) == 0) &&
            ($request->input('ticket_kid_quantity', 0) == 0) &&
            ($request->input('ticket_discount_quantity', 0) == 0) &&
            ($request->input('ticket_group_quantity', 0) == 0)
        ) {
            return redirect()->back()->withErrors(['at_least_one_ticket' => 'Необходимо купить хотя бы один билет.']);
        }

        $fetchEvent = Event::where('id', $data['event_id'])->first();
        $data['price_adult'] = $fetchEvent['price_adult'];
        $data['price_kid'] = $fetchEvent['price_kid'];
        $data['price_discount'] = $fetchEvent['price_discount'];
        $data['price_group'] = $fetchEvent['price_group'];
    

        $result = $this->orderService->addOrder($data);

        return response()->json($result);
    }
}
