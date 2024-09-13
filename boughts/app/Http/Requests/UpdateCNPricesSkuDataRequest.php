<?php

namespace App\Http\Requests;

use App\Sku;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCNPricesSkuDataRequest extends FormRequest
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
            'FloorPriceCN'=>[
                'required','numeric','min:0','lte:CeilingPriceCN'
            ],
            'CeilingPriceCN'=>'required|numeric|between:0,999.99',
            'UnitCostCN'=>'required|numeric|between:0,999.99',
        ];
    }

    public function updateSKU(Sku $sku)
    {
        $sku->fill([
            'FloorPriceCN'=>$this->FloorPriceCN,
            'CeilingPriceCN'=>$this->CeilingPriceCN,
            'UnitCostCN'=>$this->UnitCostCN,
        ]);

        $sku->save();
    }
}
