<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    
    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id','created_at','updated_at'];

    //accesores
    public function getStockAttribute(){
        if ($this->subcategory->size) {
            return  ColorSize::whereHas('size.product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        } elseif($this->subcategory->color) {
            return  ColorProduct::whereHas('product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        }else{
            return $this->quantity;
        }
    }

    //urls amigables
    public function getRouteKeyName()
    {
       return "slug"; 
    }
    
    //relacion de uno a muchos
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    //relacion uno a mucho inversa
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
        
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    //relacion mucho a muchos
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }
    //relacion uno a muchos

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function characteristics()
    {
        return $this->hasMany(Characteristic::class);
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
