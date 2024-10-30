<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function showEvents(): View
    {
        return view('events', [
            'events' => Event::all()
        ]);
    }

    public function showEvent(string $id): View
    {
        return view('event', [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function toPurchase(string $id): View
    {
        return view('purchase', [
            'event' => Event::findOrFail($id)
        ]);
    }
}
