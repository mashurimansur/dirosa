<?php

namespace App\Http\Controllers\Murobbi;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['users']   = User::where('role', 'user')->count();
        $data['murobbi'] = User::where('role', 'murobbi')->count();
        $data['halaqah'] = Halaqah::count();

        return view('murobbi.dashboard.index', $data);
    }
}
