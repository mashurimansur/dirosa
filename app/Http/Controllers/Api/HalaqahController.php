<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use Illuminate\Http\Request;
use App\Http\Resources\Halaqah as HalaqahResource;

class HalaqahController extends Controller
{
    public function getData(Request $request) {
        $halaqah = Halaqah::all();

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
}
