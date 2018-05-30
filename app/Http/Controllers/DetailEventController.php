<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Location;
use App\Ticket;

class DetailEventController extends Controller
{
    public function show(Event $event) {
        $locations = Location::all();
        $tickets = Ticket::all();
        return view('event.detail', compact('event', 'locations','tickets'));
    }
}
