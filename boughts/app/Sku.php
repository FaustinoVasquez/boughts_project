<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $table = 'SKUData';
    protected $primaryKey = "SKU";
    protected $guarded = [];


    protected $casts = [
        'ResearchComplete'=> 'bool',
        'HaveCNVariant' => 'bool',
        'Length'=>'float',
        'Width'=>'float',
        'Height'=>'float',
        'WeightOz'=>'float',
        'FloorPrice'=>'float',
        'CeilingPrice'=>'float',
        'UnitCost'=>'float',
        'FloorPriceCN'=>'float',
        'CeilingPriceCN'=>'float',
        'UnitCostCN'=>'float',
        'FloorPriceUSED'=>'float',
        'CeilingPriceUSED'=>'float',
        'UnitCostUSED'=>'float',
        'FloorPriceEU'=>'float',
        'CeilingPriceEU'=>'float',
        'FloorPriceEUCN'=>'float',
        'CeilingPriceEUCN'=>'float',
        'FloorPriceEUUSED'=>'float',
        'CeilingPriceEUUSED'=>'float',
        'Wholesale' => 'bool',
        'WholesalePrice'=>'float',
    ];

    public $incrementing = false;
    public $timestamps = false;

    public function SetResearchCompleteAttribute($value)
    {
        if(!isset($value) || $value=='false'){
            $this->attributes['ResearchComplete'] = false;
        }else{
            $this->attributes['ResearchComplete'] = $value;
        }
    }

    public function SetHaveCNVariantAttribute($value)
    {
        if(!isset($value) || $value=='false'){
            $this->attributes['HaveCNVariant'] = false;
        }else{
            $this->attributes['HaveCNVariant'] = $value ;
        }
    }

    public function SetWholesaleAttribute($value)
    {
        if(!isset($value) || $value=='false'){
            $this->attributes['Wholesale'] = false;
        }else{
            $this->attributes['Wholesale'] = $value ;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'CategoryID');
    }

    public function images()
    {
        return $this->hasMany(Image::class,'SKU');
    }

}
