<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sku extends JsonResource
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
            'CategoryID'=>$this->CategoryID,

            'CeilingPrice'=>$this->CeilingPrice,
            'CeilingPriceCN'=>$this->CeilingPriceCN,
            'CeilingPriceUSED'=>$this->CeilingPriceUSED,

            'FloorPrice'=>$this->FloorPrice,
            'FloorPriceCN'=>$this->FloorPriceCN,
            'FloorPriceUSED'=>$this->FloorPriceUSED,

            'HaveCNVariant'=>$this->HaveCNVariant,
            'Manufacturer'=>$this->Manufacturer,

            'NImages' => '',
            'PartNumber'=>$this->PartNumber,
            'Qty' => '',
            'QtyGBT' => '',
            'SKU'=>$this->SKU,

            'UnitCost'=>$this->UnitCost,
            'UnitCostCN'=>$this->UnitCostCN,
            'UnitCostUSED'=>$this->UnitCostUSED,

            'WeightOz'=>$this->WeightOz,



            'AlsoCompatibleWith'=>$this->AlsoCompatibleWith,
            'AlternatePN'=>$this->AlternatePN,
            'ResearchComplete'=>$this->ResearchComplete,
            'Length'=>$this->Length,
            'Width'=>$this->Width,
            'Height'=>$this->Height,
            'updated_at'=>$this->updated_at,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'Amazon'=>$this->Amazon,
            'eBay'=>$this->eBay,
            'OriginallySuppliedWith'=>$this->OriginallySuppliedWith,
            'CanReplaceSKUs'=>$this->CanReplaceSKUs,
            'CeilingPriceEU'=>$this->CeilingPriceEU,
            'CeilingPriceEUCN'=>$this->CeilingPriceEUCN,
            'CeilingPriceEUUSED'=>$this->CeilingPriceEUUSED,
            'FloorPriceEU'=>$this->FloorPriceEU,
            'FloorPriceEUCN'=>$this->FloorPriceEUCN,
            'FloorPriceEUUSED'=>$this->FloorPriceEUUSED,
            'Notes'=>$this->Notes,
        ];
    }
}
