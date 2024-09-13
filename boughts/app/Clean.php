<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clean extends Model
{
    protected $table = 'CleanLaunch';
    protected $primaryKey = "ID";
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
//        'SKU'=>'text',
//        'UPC'=>'float',
//        'ASIN'=>'text',
//        'Brand'=>'text',
//        'PartNumber'=>'text',
//        'AmazonTitle'=>'text',
//        'AmazonCategory'=>'text',
//        'AmazonProductType'=>'text',
//        'AmazonProductSubtype'=>'text',
//        'eBayTitle'=>'text',
//        'eBaySubtitle'=>'text',
//        'eBayCategoryID'=>'text',
//        'MobileDescription'=>'text',
//        'FullDescription'=>'text',
        'Bullet1'=>'text',
        'Bullet2'=>'text',
        'Bullet3'=>'text',
        'Bullet4'=>'text',
        'Bullet5'=>'text',
        'SearchKeywords'=>'text',
        'FloorPrice'=>'float',
        'CeilingPrice'=>'float',
        'CustomField1'=>'text',
        'CustomField2'=>'text',
        'CustomField3'=>'text',
        'CustomField4'=>'text',
        'CustomField5'=>'text',
    ];


//    public function setPartNumberAttribute($partnumber)
//    {
//        $this->attributes['PartNumber'] = Category::find($partnumber)
//            ? $partnumber
//            : Category::create(['name' => $category])->id;
//    }
}
