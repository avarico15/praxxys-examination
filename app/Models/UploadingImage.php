<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadingImage extends Model
{
    protected $table = 'tbl_uploaded_image';
    public $primarykey ='id' ;
    protected $fillable = ['name', 'file_path','product_id'];

    public function product() {
        return $this->belongsTo(Products::class);
    }
}
