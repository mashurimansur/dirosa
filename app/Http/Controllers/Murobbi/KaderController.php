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

    public function kader(Request $request)
    {
        $search = $request->input('search');
        $kader  = User::where('role', 'user');

        if (!empty($search)) {
            //We should filter gender
            $kader->where('name', 'like', '%' . $search . '%');
        }

        $data['kader'] = $kader->paginate(20);

        return view('murobbi.kader.index', $data);
    }

    public function murobbi(Request $request)
    {
        $search = $request->input('search');
        $kader  = User::where('role', 'murobbi');

        if (!empty($search)) {
            //We should filter gender
            $kader->where('name', 'like', '%' . $search . '%');
        }

        $data['kader'] = $kader->paginate(20);

        return view('murobbi.murobbi.index', $data);
    }
}
