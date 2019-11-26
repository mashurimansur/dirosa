<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Halaqah;
use Faker\Generator as Faker;

$factory->define(Halaqah::class, function (Faker $faker) {
    $mapCenterLatitude = config('leaflet.map_center_latitude');
    $mapCenterLongitude = config('leaflet.map_center_longitude');
    $minLatitude = $mapCenterLatitude - 0.05;
    $maxLatitude = $mapCenterLatitude + 0.05;
    $minLongitude = $mapCenterLongitude - 0.07;
    $maxLongitude = $mapCenterLongitude + 0.07;
    $tiers = ['Pemula', 'Menengah', 'Mahir'];
    $randTiers = array_rand($tiers);

    $day = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $randDay = array_rand($day);

    $randDate = new \DateTime();
	$randDate->setTime(mt_rand(0, 23), mt_rand(0, 59));

    return [
        'name'                  => ucwords($faker->words(2, true)),
        'tiers'                 => $tiers[$randTiers],
        'day'                   => $day[$randDay],
        'hour'                  => $randDate->format('H:i:s'),
        'location'              => 'Makassar',
        'gender'                => 'l',
        'latitude'              => $faker->latitude($minLatitude, $maxLatitude),
        'longitude'             => $faker->longitude($minLongitude, $maxLongitude),
        'start_registration'    => '2019-11-01',
        'end_registration'      => '2019-12-31',
        'user_id'               => 1,
    ];
});
