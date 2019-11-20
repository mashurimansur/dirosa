<?php

namespace App\Http\Controllers\Murobbi;
use App\Models\Halaqah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HalaqahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['halaqah'] = Halaqah::where('user_id', Auth::user()->id)->with('users')->get();

        return view('murobbi.halaqah.index', $data);
    }

    public function detail($id) {
        $data['halaqah'] = Halaqah::where('id', $id)->with('users')->first();
        return view('murobbi.halaqah.detail', $data);
    }

    public function create(){
        return view('murobbi.halaqah.create');
    }

    public function store(Request $request) {
        $halaqah = new Halaqah();
        $halaqah->name = $request->name;
        $halaqah->user_id = $request->user_id;
        $halaqah->tiers = $request->tiers;
        $halaqah->day = $request->day;
        $halaqah->hour = $request->hour;
        $halaqah->location = $request->location;
        $halaqah->latitude = $request->latitude;
        $halaqah->longitude = $request->longitude;
        $halaqah->start_registration = $request->start_registration;
        $halaqah->end_registration = $request->end_registration;
        $halaqah->save();

        return redirect()->route('halaqah.index');
    }

    public function edit($id) {
        $data['halaqah'] = Halaqah::where('id', $id)->with('users')->First();
        return view('murobbi.halaqah.edit', $data);
    }

    public function update($id, Request $request) {
        $halaqah = Halaqah::find($id);
        $halaqah->name = $request->name;
        $halaqah->user_id = $request->user_id;
        $halaqah->tiers = $request->tiers;
        $halaqah->day = $request->day;
        $halaqah->hour = $request->hour;
        $halaqah->location = $request->location;
        $halaqah->latitude = $request->latitude;
        $halaqah->longitude = $request->longitude;
        $halaqah->start_registration = $request->start_registration;
        $halaqah->end_registration = $request->end_registration;
        $halaqah->save();

        return redirect()->route('halaqah.detail', ['id' => $halaqah->id]);
    }

    public function delete($id) {
        $halaqah = Halaqah::find($id);
        $halaqah->delete();

        return redirect()->route('halaqah.index');
    }

}
