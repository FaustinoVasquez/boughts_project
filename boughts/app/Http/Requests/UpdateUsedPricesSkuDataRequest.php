<?php

namespace App\Http\Requests;

use App\Sku;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsedPricesSkuDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'SKU'=>'',
            'FloorPriceUSED'=>[
                'required','numeric','min:0','lte:CeilingPriceUSED'
            ],
            'CeilingPriceUSED'=>'required|numeric|between:0,999.99',
            'UnitCostUSED'=>'required|numeric|between:0,999.99',
        ];
    }

    public function updateSKU(Sku $sku)
    {
        $sku->fill([
            'FloorPriceUSED'=>$this->FloorPriceUSED,
            'CeilingPriceUSED'=>$this->CeilingPriceUSED,
            'UnitCostUSED'=>$this->UnitCostUSED,
        ]);

        $sku->save();
    }
}
