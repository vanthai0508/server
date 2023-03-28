<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'link_test' => $this->link_test,
            'path' => $this->path,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'update_at' => Carbon::parse($this->create_at)->format('d/m/Y'),
            'category' => $this->category
          ];
    }
}
