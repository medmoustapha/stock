<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Stock extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'stockName' => $this->stockName,
          'stockPrice' => $this->stockPrice,
          'stockYear'=> $this->stockYear,
        ];
    }
}
