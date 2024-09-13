<?php

namespace App\Http\Requests;

use App\Sku;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewPricesSkuDataRequest extends FormRequest
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
            'FloorPrice'=>[
                'required','numeric','min:0','lte:CeilingPrice'
            ],
            'CeilingPrice'=>'required|numeric|between:0,999.99',
            'UnitCost'=>'required|numeric|between:0,999.99',
        ];
    }

    public function updateSKU(Sku $sku)
    {
        $sku->fill([
            'FloorPrice'=>$this->FloorPrice,
            'CeilingPrice'=>$this->CeilingPrice,
            'UnitCost'=>$this->UnitCost,
        ]);

        $sku->save();
    }
}
