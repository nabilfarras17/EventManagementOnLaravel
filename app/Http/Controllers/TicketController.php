<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index() {
        $tickets = Ticket::all();
        return view('ticket.index', compact('tickets'));
    }

    public function create() {
        return view('ticket.create');
    }

    public function store(Request $request) {
        $data = $this->validate($request, [
            'name'=>'required',
            'type'=> 'required',
            'amount' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        if($request->type === "Free" && $request->price > 0){
            return redirect("ticket");
        }
        elseif($request->type === "Berbayar" && $request->price < 0){
            return redirect("ticket");
        }

        Ticket::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'amount' => $data['amount'],
            'price' => $data['price'],
            'description' => $data['description'],
            'created_by' => 1
        ]);

        return redirect('ticket')->with('success','Ticket created successfully.');
    }

    public function edit(Ticket $ticket) {
        return view('ticket.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket) {
        $data = $this->validate($request, [
            'name'=>'required',
            'type'=> 'required',
            'amount' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        if($request->type === "Free" && $request->price > 0){
            return redirect("ticket");
        }
        elseif($request->type === "Berbayar" && $request->price < 0){
            return redirect("ticket");
        }

        $ticket->name = $data['name'];
        $ticket->type = $data['type'];
        $ticket->amount = $data['amount'];
        $ticket->price = $data['price'];
        $ticket->description = $data['description'];
        $ticket->created_by = 1;
        $ticket->save();
        return redirect('ticket')->with('success','Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket) {
        $ticket->delete();
        return redirect('ticket')->with('success','Ticket deleted successfully.');
    }
}