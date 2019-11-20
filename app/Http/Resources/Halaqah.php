<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Halaqah extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'tiers' => $this->tiers,
            'day' => $this->day,
            'hour' => $this->hour,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'start_registration' => $this->start_registration,
            'end_registration' => $this->end_registration,
            'map_popup_content' => $this->content($this),
        ];
    }

    public function content($data) {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>Halaqah Name :</strong><br>'.$data->name.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>Coordinate :</strong><br>'.$data->latitude.' - '.$data->longitude.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>Location :</strong><br>'.$data->location.'</div>';

        return $mapPopupContent;
    }
}
