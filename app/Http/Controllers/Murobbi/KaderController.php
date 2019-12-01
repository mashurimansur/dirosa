<?php

namespace App\Http\Controllers\Murobbi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kader() {
        $data['kader'] = User::where('role', 'user')->paginate(20);

        return view('murobbi.kader.index', $data);
    }

    public function murobbi() {
        $data['kader'] = User::where('role', 'murobbi')->paginate(20);

        return view('murobbi.murobbi.index', $data);
    }
}
