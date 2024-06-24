<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'driver_id' => $this->driver_id,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'vehicle' =>$this->vehicle->vehicle_plate_no,



        ];
    }
}
