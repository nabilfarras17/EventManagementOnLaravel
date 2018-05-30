<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Event;
use App\Location;
use App\EventRelationsWithTicket;
use Abraham\TwitterOAuth\TwitterOAuth;

class EventController extends Controller
{
    //
    public function index() {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function create() {
        $locations = Location::all();
        $tickets = Ticket::all();
        return view("event.create", compact('locations','tickets'));
    }

    public function store(Request $request) {
        $data = $this->validate($request, [
            'name'=>'required',
            'category'=> 'required',
            'event_date' => 'required',
            'location' =>'required',
            'ticket' => 'required',
            'description' => 'required'
        ]);

        $event = Event::create([
            'name' => $data['name'],
            'category' => $data['category'],
            'event_date' => $data['event_date'],
            'description' => $data['description'],
            'created_by' => 1,
            'location_id' => $data['location']
        ]);

        foreach ($data['ticket'] as $ticket){
            EventRelationsWithTicket::create([
                'event_id' => $event->id,
                'ticket_id' => $ticket
            ]);
        }

        return redirect('event')->with('success','Event created successfully.');
    }

    public function edit(Event $event) {
        $locations = Location::all();
        $tickets = Ticket::all();
        return view('event.edit', compact('event','locations','tickets'));
    }

    public function update(Request $request, Event $event) {
        $data = $this->validate($request, [
            'name'=>'required',
            'category'=> 'required',
            'event_date' => 'required',
            'location' =>'required',
            'ticket' => 'required',
            'description' => 'required'
        ]);

        $event->name = $data['name'];
        $event->category = $data['category'];
        $event->event_date = $data['event_date'];
        $event->description = $data['description'];
        $event->created_by = 1;
        $event->location_id = $data['location'];
        $event->save();

        EventRelationsWithTicket::where('event_id',$event->id)->delete();

        foreach ($data['ticket'] as $ticket){
            EventRelationsWithTicket::create([
                'event_id' => $event->id,
                'ticket_id' => $ticket
            ]);
        }

        return redirect('event')->with('success','Event updated successfully.');
    }

    public function show(Event $event) {
        $locations = Location::all();
        $tickets = Ticket::all();
        return view('event.show', compact('event', 'locations','tickets'));
    }

    public function destroy(Event $event) {
        $event->delete();
        return redirect('event')->with('success','Event deleted successfully.');
    }

    public function postTwitter(Event $event) {
        $url = 'http://127.0.0.1:8000/event/detail/';
        $content = 'Please see my '.$event->name.' here: '.$url.$event->id;

        $connection = new TwitterOAuth(
            'TYvSatnWjMykYgeZesyFmAzI2',
            '3lTR7yS0zG2p0l9bgD6LjpxBFPstZ8OOPIk6ri2Ea7PfvfSiHv',
            '918049346326687744-aei0hT4hCloaYg6M0WVZu48SG2s2Cin',
            'hWDeSBzh88B1rvTYllyKNJ4mhBlbxsQ0IPPiIY6uCscum'
        );
        $connection->post("statuses/update", ["status" => $content]);
        return redirect('event')->with('success','Event Post to Twitter successfully.');
    }
}
