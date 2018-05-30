<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Location;

class LocationController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

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
            'created_id' => 6
        ]);

        return redirect('location')->with('success','Location created successfully.');
    }

    public function edit(Location $location) {
        return view('location.edit', compact('location'));
    }

    public function update(Request $request, Location $location) {
        $location->name = $request->get('name');
        $location->address = $request->get('address');
        $location->save();
        return redirect('location')->with('success','Location updated successfully.');
    }

    public function destroy(Location $location) {
        $location->delete();
        return redirect('location')->with('success','Location deleted successfully.');
    }


    public function index() {
        $locations = Location::all();
        return view('location.index', compact('locations'));
    }
}
