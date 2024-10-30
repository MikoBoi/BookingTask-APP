<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Ticket;

use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function generateUniqueBarcode() {
        $number = '';
        for ($i = 0; $i < 16; $i++) {
            $number .= random_int(0, 9);
        }
        if (Ticket::where('barcode', $number )->exists()) {
            return $this->generateUniqueBarcode();
        }
        return $number;
    }

    public function addOrder($data)
    {
        $equal_price = ($data['price_adult'] * $data['ticket_adult_quantity']) + ($data['price_kid'] * $data['ticket_kid_quantity']) + ($data['price_discount'] * $data['ticket_discount_quantity']) + ($data['price_group'] * $data['ticket_group_quantity']);
        $createOrder = Order::create([
            'event_id' => $data['event_id'],
            'ticket_adult_quantity' => $data['ticket_adult_quantity'],
            'ticket_kid_quantity' => $data['ticket_kid_quantity'],
            'ticket_discount_quantity' => $data['ticket_discount_quantity'],
            'ticket_group_quantity' => $data['ticket_group_quantity'],
            'user_id' => Auth::user()->id,
            'equal_price' => $equal_price,
            'created' => now(),
        ]);

        $this->createTickets($createOrder->id, $data);

        return ['message' => 'order successfully booked'];
    }

    public function createTickets($orderId, $data)
    {
        for ($i = 0; $i < $data['ticket_adult_quantity']; $i++) {
            Ticket::create([
                'order_id' => $orderId,
                'event_id' => $data['event_id'],
                'ticket_type' => 'adult',
                'price' => $data['price_adult'],
                'barcode' => $this->generateUniqueBarcode(),
            ]);
        }
    
        for ($i = 0; $i < $data['ticket_kid_quantity']; $i++) {
            Ticket::create([
                'order_id' => $orderId,
                'event_id' => $data['event_id'],
                'ticket_type' => 'kid',
                'price' => $data['price_kid'],
                'barcode' => $this->generateUniqueBarcode(),
            ]);
        }
    
        for ($i = 0; $i < $data['ticket_discount_quantity']; $i++) {
            Ticket::create([
                'order_id' => $orderId,
                'event_id' => $data['event_id'],
                'ticket_type' => 'discount',
                'price' => $data['price_discount'],
                'barcode' => $this->generateUniqueBarcode(),
            ]);
        }
    
        for ($i = 0; $i < $data['ticket_group_quantity']; $i++) {
            Ticket::create([
                'order_id' => $orderId,
                'event_id' => $data['event_id'],
                'ticket_type' => 'group',
                'price' => $data['price_group'],
                'barcode' => $this->generateUniqueBarcode(),
            ]);
        }
    }

    private function mockBookOrder($data)
    {
        $responses = [
            ['message' => 'order successfully booked'],
            ['error' => 'barcode already exists']
        ];
        
        return $responses[array_rand($responses)];
    }

    private function mockApproveOrder($barcode)
    {
        $responses = [
            ['message' => 'order successfully approved'],
            ['error' => 'event cancelled'],
            ['error' => 'no tickets'],
            ['error' => 'no seats'],
            ['error' => 'fan removed']
        ];
        
        return $responses[array_rand($responses)];
    }
}