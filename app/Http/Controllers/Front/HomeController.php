<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\HalaqahResource;
use App\Models\Halaqah;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index(){
        $halaqah = Halaqah::with('murobbi')->get();

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

    public function detailHalaqah($id) {
        $data['halaqah'] = Halaqah::where('id', $id)->with('murobbi')->first();

        return view('front.home.detail', $data);
    }
}
