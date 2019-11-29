<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\HalaqahUser;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::guest()){
            $data['halaqah'] = Halaqah::with('murobbi')->get();
            return view('front.home.indexNotSignin', $data);

        } else {
            $halaqah = Halaqah::with('murobbi')
                // ->where('start_registration', '>=', date('Y-m-d'))
                // ->where('end_registration', '<=', date('Y-m-d'))
                ->get();

            // $data['halaqah'] = [];
            foreach ($halaqah as $h) {
                $data['halaqah'][] = [
                    'id'                 => $h->id,
                    'name'               => $h->name,
                    'gender'             => $h->gender,
                    'user_id'            => $h->user_id,
                    'tiers'              => $h->tiers,
                    'day'                => $h->day,
                    'hour'               => $h->hour,
                    'location'           => $h->location,
                    'latitude'           => $h->latitude,
                    'longitude'          => $h->longitude,
                    'start_registration' => $h->start_registration,
                    'end_registration'   => $h->end_registration,
                    'murobbi'            => $h->murobbi,
                    'distance'           => $this->getDistance(Auth::user()->latitude, Auth::user()->longitude, $h->latitude, $h->longitude)
                ];
            };


            $data['halaqah'] = $halaqah;
            return view('front.home.index', $data);
        }
    }

    public function getDistance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles= $dist * 60 * 1.1515;
                $unit = 'K';
                $km   = $miles*1.609344;
                $data =  number_format($km,1);
        return $data;
    }

    public function halaqah()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $data['user'] = User::where('id', Auth::user()->id)->with('halaqah')->first();

        return view('front.halaqah.index', $data);
    }

    public function detailHalaqah($id) {
        $data['halaqah'] = Halaqah::where('id', $id)->with('murobbi', 'users')->first();
        $data['check'] = HalaqahUser::where('halaqah_id', $id)->where('user_id', Auth::user()->id)->count();

        return view('front.home.detail', $data);
    }

    // Profile Setting
    public function editProfile()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        $data['user'] = User::find(Auth::user()->id);

        return view('front.profile.index', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'gender' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required|max:150',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        // $user->role = $request->role;
        $user->address = $request->address;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $destinationPath = 'uploads';
            $extension = $file->getClientOriginalExtension();
            $filename = rand(111111, 999999) . "." . $extension;
            $file->move($destinationPath, $filename);
            $user->image = $filename;
        }

        if ($request->password != '') {
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->back();
    }

    // About
    public function about()
    {
        return view('front.about.index');
    }

    public function registerMurobbi() {
        return view('auth.registerMurobbi');
    }

    public function joinHalaqah(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'halaqah_id' => 'required'
        ]);

        $hu = new HalaqahUser();
        $hu->user_id = $request->user_id;
        $hu->halaqah_id = $request->halaqah_id;
        $hu->save();

        return redirect()->back();

    }
}
