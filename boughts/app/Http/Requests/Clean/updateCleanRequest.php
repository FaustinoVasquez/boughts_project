<?php

namespace App\Http\Requests\Clean;

use App\Clean;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateCleanRequest extends FormRequest
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
        $upc = $this->get('UPC');
        $asin = $this->get('ASIN');

        return [
            'SKU' => 'required',
            'UPC' => ['required_without:ASIN','digits:12',Rule::unique('sqlsrv.dbo.CleanLaunch', 'UPC')
                ->where(function($query) use ($upc) {
                    $query->where('SKU', $upc);
                })->ignore($this->ID),
            ],
            'ASIN' => ['required_without:UPC','max:15',Rule::unique('sqlsrv.dbo.CleanLaunch', 'ASIN')
                ->where(function($query) use ($asin) {
                    $query->where('SKU', $asin);
                })->ignore($this->ID),
            ],
            'Brand' =>'required|max:50|exists:sqlsrv.dbo.SKUData,Manufacturer',
            'PartNumber' => 'required|max:50',
            'Condition' =>[Rule::in(['New','Used','CN'])],
            'AmazonTitle'=>'required|max:200',
            'AmazonCategory'=>'required|max:50',
            'AmazonProductType'=>'required|max:50',
            'AmazonProductSubtype'=>'required|max:50',
            'AmazonShipTemplate'=>'required|max:20',
            'eBayTitle'=>'required|max:80',
            'eBaySubtitle'=>'max:80',
            'MobileDescription'=>'required|max:800',
            'FullDescription'=>'required|max:2000',
            'Bullet1'=>'required|max:500',
            'Bullet2'=>'max:500',
            'Bullet3'=>'max:500',
            'Bullet4'=>'max:500',
            'Bullet5'=>'max:500',
            'SearchKeywords'=>'required|max:200',
            'FloorPrice'=>[
                'required','regex:/^\d+(\.\d{1,2})?$/','min:0','lte:CeilingPrice'
            ],
            'CeilingPrice'=>'required|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'CustomField1'=>'max:200',
            'CustomField2'=>'max:200',
            'CustomField3'=>'max:200',
            'CustomField4'=>'max:200',
            'CustomField5'=>'max:200',
        ];
    }

    public function updateCleanLaunch(Clean $clean)
    {
        $clean->fill([
            'SKU' =>$this->SKU,
            'UPC' =>$this->UPC,
            'ASIN' =>$this->ASIN,
            'Brand' =>$this->Brand,
            'PartNumber' =>$this->PartNumber,
            'Condition' =>$this->Condition,
            'AmazonTitle'=>$this->AmazonTitle,
            'AmazonCategory'=>$this->AmazonCategory,
            'AmazonProductType'=>$this->AmazonProductType,
            'AmazonProductSubtype'=>$this->AmazonProductSubtype,
            'AmazonShipTemplate'=>$this->AmazonShipTemplate,
            'eBayTitle'=>$this->eBayTitle,
            'eBaySubtitle'=>$this->eBaySubtitle,
            'MobileDescription'=>$this->MobileDescription,
            'FullDescription'=>$this->FullDescription,
            'Bullet1'=>$this->Bullet1,
            'Bullet2'=>$this->Bullet2,
            'Bullet3'=>$this->Bullet3,
            'Bullet4'=>$this->Bullet4,
            'Bullet5'=>$this->Bullet5,
            'SearchKeywords'=>$this->SearchKeywords,
            'FloorPrice'=>$this->FloorPrice,
            'CeilingPrice'=>$this->CeilingPrice,
            'CustomField1'=>$this->CustomField1,
            'CustomField2'=>$this->CustomField2,
            'CustomField3'=>$this->CustomField3,
            'CustomField4'=>$this->CustomField4,
            'CustomField5'=>$this->CustomField5,
        ]);

        $clean->save();
    }
}
