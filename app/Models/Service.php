<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //urls amigables
    public function getRouteKeyName()
    {
       return "slug"; 
    }

    //uno a muchos polimorphica
    public function images()
    {
        return $this->morphMany(Image::class, "imageable");
    }

    public function featuredImage()
    {
        $featuredImage = $this->images->first();
        if (!$featuredImage) {
            return 'imagen_no.png';
        }
        return $featuredImage->url;
    }
}
