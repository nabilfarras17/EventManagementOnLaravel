<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Location;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $locations = Location::where('created_id', Auth::user()->id)->get();
        return view('location.index', compact('locations'));
    }

    public function create() {
      return view("location.create");
    }

    public function store(Request $request) {
        $data = $this->validate($request, [
            'name'=>'required',
            'address'=> 'required'
        ]);

        Location::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'created_id' => Auth::user()->id
        ]);

        return redirect('location')->with('success','Location created successfully.');
    }

    public function edit(Location $location) {
        return view('location.edit', compact('location'));
    }

    public function update(Request $request, Location $location) {
        $location->name = $request->get('name');
        $location->address = $request->get('address');
        $location->created_id = Auth::user()->id;
        $location->save();
        return redirect('location')->with('success','Location updated successfully.');
    }

    public function destroy(Location $location) {
        $location->delete();
        return redirect('location')->with('success','Location deleted successfully.');
    }
}
