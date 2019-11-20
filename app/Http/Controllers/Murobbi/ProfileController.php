<?php

namespace App\Http\Controllers\Murobbi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function edit() {
        $data['user'] = User::find(Auth::user()->id);

        return view('murobbi.profile.edit', $data);
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        // $user->role = $request->role;
        $user->address = $request->address;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $destinationPath = 'uploads';
            $extension = $file->getClientOriginalExtension();
            $filename = rand(111111,999999).".".$extension;
            $file->move($destinationPath, $filename);
            $user->image = $filename;
        }

        if($request->password != '') {
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->back();
    }
}
