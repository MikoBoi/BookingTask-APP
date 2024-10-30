<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function showTickets(): View
    {
        $tickets = [];
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $tickets = $orders;
        foreach($orders as $index => $item){
            $purchasedTcikets[] = Ticket::where('order_id', $item->id)->get();
            $tickets[$index]["Tickets"] = $purchasedTcikets;
        };
        return view('tickets', [
            'ticketCollection' => $tickets
        ]);
    }
}
