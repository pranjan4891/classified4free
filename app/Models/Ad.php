<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'vid',
        'uuid',
        'title',
        'description',
        'price',
        'negotiable_price',
        'country_id',
        'city_name',
        'featured_image',
        'tags',
        'company_name',
        'email',
        'phone',
        'category_id',
        'subcategory_id',
        'views',
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

}
