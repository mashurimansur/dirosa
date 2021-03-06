# Laravel Leaflet JS - Aplikasi Dirosa

This is an project for [Leaflet JS](https://leafletjs.com) and [OpenStreetMap](https://www.openstreetmap.org) built with Laravel 6.0.

![Laravel Leaflet JS Project Example](public/screenshots/capture.PNG)

## Features

In this project, we have an Halaqah Dirosa Management (CRUD) with location/coordinate point that shown in map.
### Leaflet config

We have a `config/leaflet.php` file in this project. Set default **zoom level** and **map center** coordinate here (or in `.env` file).

```php
<?php

return [
    'zoom_level'           => 13,
    'detail_zoom_level'    => 16,
    'map_center_latitude'  => env('MAP_CENTER_LATITUDE', '-5.1609734'),
    'map_center_longitude' => env('MAP_CENTER_LONGITUDE', '119.4760907'),
];
```

> Please note that this is not an official or required config file from Leaflet JS, it is just a custom config for this project.

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
