<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mkt extends Model
{
    protected $table = 'MarketPlaceMapping';
    protected $primaryKey = "ID";
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = [
        'Stamp',
    ];

    protected $casts = [
        'IsCN'=> 'bool',
        'IsSnL'=> 'bool',
        'HaveCNVariant' => 'bool',
        'Floor'=>'float',
        'Ceiling'=>'float',
    ];

    public function GetIsCNAttribute()
    {
        if($this->IsCN !== null){
            return $this->IsCN ? true : false;
        }
    }

    public function GetIsSnLAttribute()
    {
        if($this->IsSnL !== null){
            return $this->IsSnL ? true : false;
        }
    }

    public function SetIsCNAttribute($value)
    {
        if(!isset($value) || $value=='false'){
            $this->attributes['IsCN'] = false;
        }else{
            $this->attributes['IsCN'] = $value;
        }
    }

    public function SetIsSnLAttribute($value)
    {
        if(!isset($value) || $value=='false'){
            $this->attributes['IsSnL'] = false;
        }else{
            $this->attributes['IsSnL'] = $value;
        }
    }

    public function getNewMerchantSKU($sku)
    {
        $lastSku = $this->where('SKU',$sku)->orderBy('ID','DESC')->first();


        if($lastSku){
            $number=explode("-", $lastSku->MerchantSKU)[1] + 1;

        }else{
            $number=1;
        }

        return $sku.'-'.str_pad($number, 3, '0', STR_PAD_LEFT);


//
//        $number=1;
//
//        $mSkus=$this->where('MerchantSKU','like','%'.$sku.'%')->get();
//
//        if(!$mSkus->isEmpty()){
//            $number = explode('-', $mSkus->last()->MerchantSKU, 2)[1] + 1;
//        }
//
//        if ($number<=99){
//            if($number<=9){
//                return $sku.'-00'.$number;
//            }
//            return $sku.'-0'.$number;
//        }else{
//            return $sku.'-'.$number;
//        }

    }

}
