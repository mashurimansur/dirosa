<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use Illuminate\Http\Request;
use App\Http\Resources\HalaqahResource;

class HalaqahController extends Controller
{
    public function getData(Request $request) {
        $halaqah = Halaqah::with('murobbi')->get();

        $geoJSONData = $halaqah->map(function ($halaqah){
            return [
                'type' => 'Feature',
                'properties' => new HalaqahResource($halaqah),
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $halaqah->longitude,
                        $halaqah->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJSONData,
        ]);
    }

    public function getFilter(Request $request)
    {
        $gender = $request->input('gender');
        $tiers = $request->input('tiers');
        $day = $request->input('day');
        $hour = $request->input('hour');

        $halaqah = Halaqah::with('murobbi');

        if (!empty($gender)) {
            //We should filter gender
            $halaqah->where('gender', $gender);
        }
        if (!empty($tiers)) {
            //We should filter tiers
            $halaqah->where('tiers', $tiers);
        }
        if (!empty($day)) {
            //We should filter day
            $halaqah->where('day', $day);
        }
        if (!empty($hour)) {
            //We should filter hour
            $halaqah->where('hour', $hour);
        }

        $halaqah = $halaqah->limit(10)->get();

        return response()->json($halaqah, 200);
    }
}
