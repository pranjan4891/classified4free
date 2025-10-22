<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'price',
        'negotiable_price',
        'country_id',
        'city_id',
        'featured_image',
        'tags',
        'company_name',
        'email',
        'phone',
        'category_id',
        'subcategory_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
