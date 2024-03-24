<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "second_name" => $this->second_name,
            "avatar" => $this->avatar,
            "city" => $this->city,
            "country" => $this->country,
            "date_born" => $this->date_born,
            "hobbies" => $this->hobbies,
            "description" => $this->description,
        ];
    }
}
