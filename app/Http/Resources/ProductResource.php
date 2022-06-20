<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     'name' => ucwords($this->name),
        //     'price' => $this->price
        // ];
        // devolve todos items em um array pq é um model eloquent que tem method toArray
        return $this->resource->toArray();
    }

    public function with($request)
    {
        return ['extra_information' => 'Informação extra dentro metodo with'];
    }
}
