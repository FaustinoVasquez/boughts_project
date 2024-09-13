<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'Image';
    protected $primaryKey = "ID";
    protected $guarded = [];


    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}
