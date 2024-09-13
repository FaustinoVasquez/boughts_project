<?php

namespace App\Http\Requests\Catalog;

use App\Sku;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CreateSkuDataRequest extends FormRequest
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
        $partNumber = $this->get('PartNumber');
        $manufacturer = $this->get('Manufacturer');
        return [
            'SKU'=>'',
            'Manufacturer'=>[
                'required',Rule::unique('sqlsrv.dbo.SKUData', 'Manufacturer')
                    ->where(function($query) use ($partNumber) {
                        $query->where('PartNumber', $partNumber);
                    })->ignore($this->sku),
            ],
            'PartNumber'=>[
                'required', Rule::unique('sqlsrv.dbo.SKUData', 'PartNumber')
                    ->where(function($query) use ($manufacturer) {
                        $query->where('Manufacturer', $manufacturer);
                    })->ignore($this->sku),
            ],
            'CategoryID'=>'required|exists:sqlsrv.dbo.Categories,CategoryID',
            'AlternatePN'=>'',
            'AlternatePN2' =>'',
            'OriginallySuppliedWith'=>'',
            'AlsoCompatibleWith'=>'',
            'Notes'=>'',
            'WebDescription'=>'',
            'Length'=>'required|numeric|between:0,999.99',
            'Width'=>'required|numeric|between:0,999.99',
            'Height'=>'required|numeric|between:0,999.99',
            'WeightOz'=>'required|numeric|between:0,999.99',

            'FloorPrice'=>[
                'required','numeric','min:0','lte:CeilingPrice'
            ],
            'CeilingPrice'=>'required|numeric|between:0,999.99',
            'UnitCost'=>'required|numeric|between:0,999.99',

            'FloorPriceCN'=>[
                'required','numeric','min:0','lte:CeilingPriceCN'
            ],
            'CeilingPriceCN'=>'required|numeric|between:0,999.99',
            'UnitCostCN'=>'required|numeric|between:0,999.99',
            'FloorPriceUSED'=>[
                'required','numeric','min:0','lte:CeilingPriceUSED'
            ],
            'CeilingPriceUSED'=>'required|numeric|between:0,999.99',
            'UnitCostUSED'=>'required|numeric|between:0,999.99',
            'FloorPriceEU'=>[
                'required','numeric','min:0','lte:CeilingPriceEU'
            ],
            'CeilingPriceEU'=>'required|numeric|between:0,999.99',
            'FloorPriceEUCN'=>[
                'required','numeric','min:0','lte:CeilingPriceEUCN'
            ],
            'CeilingPriceEUCN'=>'required|numeric|between:0,999.99',
            'FloorPriceEUUSED'=>[
                'required','numeric','min:0','lte:CeilingPriceEUUSED'
            ],
            'CeilingPriceEUUSED'=>'required|numeric|between:0,999.99',
            'ResearchComplete'=>[Rule::in(['true','false'])],
            'HaveCNVariant'=>[Rule::in(['true','false'])],
            'Wholesale'=>[Rule::in(['true','false'])],
            'WholesalePrice'=>'regex:/^\d+(\.\d{1,2})?$/|min:0|required_with:Wholesale',
            'WholesaleInvPercent'=>'numeric|required_with:Wholesale',
        ];
    }

    public function crateSKU()
    {
        $sku = new Sku;

        $sku->fill([
            'SKU'=> DB::select("EXEC [Remotes].[dbo].[sp_CreateSKU]")[0]->SKU,
            'Manufacturer'=>$this->Manufacturer,
            'PartNumber'=>$this->PartNumber,
            'CategoryID'=>$this->CategoryID,
            'AlternatePN'=>$this->AlternatePN,
            'AlternatePN2'=>$this->AlternatePN2,
            'OriginallySuppliedWith'=>$this->OriginallySuppliedWith,
            'AlsoCompatibleWith'=>$this->AlsoCompatibleWith,
            'Notes'=>$this->Notes,
            'WebDescription'=>$this->WebDescription,
            'Length'=>$this->Length,
            'Width'=>$this->Width,
            'Height'=>$this->Height,
            'WeightOz'=>$this->WeightOz,
            'FloorPrice'=>$this->FloorPrice,
            'CeilingPrice'=>$this->CeilingPrice,
            'UnitCost'=>$this->UnitCost,
            'FloorPriceCN'=>$this->FloorPriceCN,
            'CeilingPriceCN'=>$this->CeilingPriceCN,
            'UnitCostCN'=>$this->UnitCostCN,
            'FloorPriceUSED'=>$this->FloorPriceUSED,
            'CeilingPriceUSED'=>$this->CeilingPriceUSED,
            'UnitCostUSED'=>$this->UnitCostUSED,
            'FloorPriceEU'=>$this->FloorPriceEU,
            'CeilingPriceEU'=>$this->CeilingPriceEU,
            'FloorPriceEUCN'=>$this->FloorPriceEUCN,
            'CeilingPriceEUCN'=>$this->CeilingPriceEUCN,
            'FloorPriceEUUSED'=>$this->FloorPriceEUUSED,
            'CeilingPriceEUUSED'=>$this->CeilingPriceEUUSED,
            'ResearchComplete'=>$this->ResearchComplete,
            'HaveCNVariant'=>$this->HaveCNVariant,
            'WholesalePrice'=>$this->WholesalePrice,
            'WholesaleInvPercent'=>$this->WholesaleInvPercent,
        ]);

        if(!isset($this->HaveCNVariant)){
            $sku->HaveCNVariant = false;
        }
        if(!isset($this->ResearchComplete)){
            $sku->ResearchComplete = false;
        }
        if(!isset($this->Wholesale)){
            $sku->Wholesale = false;
        }

        $sku->save();
    }
}
