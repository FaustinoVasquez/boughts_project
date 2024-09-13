<?php

namespace App\Http\Requests\Market;

use App\Mkt;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMarketRequest extends FormRequest
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
            'SKU'=>'required|exists:sqlsrv.dbo.SkuData,SKU',
            'Condition'=> ['required',Rule::in(['New','Used - Very Good','Used - Like New','Refurbished'])],
            'FulfillmentType'=>['required',Rule::in(['Amazon','Merchant','Walmart'])],
            'MerchantSKU'=>'Required',
            'ASIN'=>'Required',
            'IsCN'=>[Rule::in(['true','false'])],
            'IsSnL'=>[Rule::in(['true','false'])],
            'DumpIt'=>[Rule::in(['true','false'])],
            'Floor'=>[
                'required','numeric','min:0','lte:Ceiling'
            ],
            'Ceiling'=>'required|numeric|between:0,999.99',
        ];
    }

    public function crateMKT(Mkt $mkt)
    {

        $mkt->fill([
            'SKU'=>$this->SKU,
            'Condition'=>$this->Condition,
            'FulfillmentType'=>$this->FulfillmentType,
            'MerchantSKU'=>$this->MerchantSKU,
            'ASIN'=>$this->ASIN,
            'IsCN'=>$this->IsCN,
            'IsSnL'=>$this->IsSnL,
            'DumpIt' => $this->DumpIt,
            'Floor'=>$this->Floor,
            'Ceiling'=>$this->Ceiling,
        ]);

        if(!isset($this->IsCN)){
            $mkt->IsCN = false;
        }
        if(!isset($this->IsSnL)){
            $mkt->IsSnL = false;
        }
        $mkt->save();
    }
}
