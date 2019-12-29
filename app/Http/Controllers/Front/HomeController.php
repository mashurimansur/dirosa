<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\HalaqahUser;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            $data['halaqah'] = Halaqah::with('murobbi')
                ->where('start_registration', '<=', date('Y-m-d'))
                ->where('end_registration', '>=', date('Y-m-d'))
                ->paginate(10);

            return view('front.home.indexNotSignin', $data);

        } else {
            $data['halaqah'] = Halaqah::with('murobbi')
                ->where('start_registration', '<=', date('Y-m-d'))
                ->where('end_registration', '>=', date('Y-m-d'))
                ->paginate(10);

            return view('front.home.index', $data);
        }
    }

    public function filter()
    {
        $data['halaqah'] = Halaqah::with('murobbi')->limit(10)->get();

        // return response()->json($data);
        return view('front.home.filter', $data);
    }

    public function halaqah()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $data['user'] = User::where('id', Auth::user()->id)->with('halaqah.murobbi')->first();
        // return response()->json($data, 200);
        return view('front.halaqah.index', $data);
    }

    public function detailHalaqah($id)
    {
        $data['halaqah'] = Halaqah::where('id', $id)->with('murobbi', 'users')->first();

        if (!Auth::guest()) {
            $data['check'] = HalaqahUser::where('halaqah_id', $id)->where('user_id', Auth::user()->id)->count();
        }

        return view('front.halaqah.detail', $data);
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
            'name'      => 'required|min:5|max:30',
            'email'     => 'required|email|unique:users,email,' . Auth::user()->id,
            'gender'    => 'required',
            'phone'     => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
            'address'   => 'required|max:150',
        ]);

        $user            = User::find(Auth::user()->id);
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->gender    = $request->gender;
        $user->phone     = $request->phone;
        $user->latitude  = $request->latitude;
        $user->longitude = $request->longitude;
        // $user->role = $request->role;
        $user->address = $request->address;

        if ($request->hasfile('image')) {
            $file            = $request->file('image');
            $destinationPath = 'uploads';
            $extension       = $file->getClientOriginalExtension();
            $filename        = rand(111111, 999999) . "." . $extension;
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

    public function registerMurobbi()
    {
        return view('auth.registerMurobbi');
    }

    public function joinHalaqah(Request $request)
    {
        $request->validate([
            'user_id'    => 'required',
            'halaqah_id' => 'required',
        ]);

        $hu             = new HalaqahUser();
        $hu->user_id    = $request->user_id;
        $hu->halaqah_id = $request->halaqah_id;
        $hu->save();

        return redirect()->back();
    }

    public function outHalaqah(Request $request)
    {
        $request->validate([
            'user_id'    => 'required',
            'halaqah_id' => 'required',
        ]);

        HalaqahUser::where('user_id', $request->user_id)->where('halaqah_id', $request->halaqah_id)->delete();

        return redirect()->back();
    }
}
