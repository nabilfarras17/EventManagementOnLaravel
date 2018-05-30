<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Event;
use App\Location;
use App\EventRelationsWithTicket;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;
use Config;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $events = Event::where('created_by', Auth::User()->id)->get();
        return view('event.index', compact('events'));
    }

    public function create() {
        $locations = Location::where('created_id', Auth::User()->id)->get();
        $tickets = Ticket::where('created_by', Auth::User()->id)->get();
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
            'created_by' => Auth::User()->id,
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
        $locations = Location::where('created_id', Auth::User()->id)->get();
        $tickets = Ticket::where('created_by', Auth::User()->id)->get();
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
        $event->created_by = Auth::User()->id;
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
        $locations = Location::where('created_id', Auth::User()->id)->get();
        $tickets = Ticket::where('created_by', Auth::User()->id)->get();
        return view('event.show', compact('event', 'locations','tickets'));
    }

    public function destroy(Event $event) {
        $event->delete();
        return redirect('event')->with('success','Event deleted successfully.');
    }

    public function postTwitter(Event $event) {
        $url = Config::get('services.pathDetailEvent');
        $content = 'Please see my '.$event->name.' here: '.$url.$event->id;
        $connection = new TwitterOAuth(
            Config::get('services.twitter.client_id'),
            Config::get('services.twitter.client_secret'),
            Auth::user()->access_token,
            Auth::user()->access_token_secret
        );
        $connection->post("statuses/update", ["status" => $content]);
        return redirect('event')->with('success','Event Post to Twitter successfully.');
    }
}
