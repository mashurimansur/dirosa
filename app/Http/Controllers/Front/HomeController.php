<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['halaqah'] = Halaqah::with('murobbi')->get();
        // return response()->json($data, 200);
        return view('front.home.index', $data);
    }
}
