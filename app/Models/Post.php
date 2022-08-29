<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeCreatedDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeUpdatedDate($query, $date)
    {
        return $query->whereDate('updated_at', $date);
    }

    public function scopeActive($query, $active = true)
    {
        return $query->where('active', $active);
    }

    public function scopeBelongsToUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCategoryOrSubcategory($query, $category, $subcategory)
    {
        if (!$subcategory) {
            if (!$category) {
                return $query;
            }
            return $query->WhereRaw('subcategory_id IN (SELECT id FROM subcategories WHERE category_id=?)', [$category]);
        }

        return $query->where('subcategory_id', $subcategory);
    }

    public function scopeCategory($query, $category)
    {
        if (!$category) {
            return $query;
        }

        return $query->WhereRaw('subcategory_id IN (SELECT id FROM subcategories WHERE category_id=?)', [$category]);
    }

    public function scopeSubcategory($query, $subcategory)
    {
        if (!$subcategory) {
            return $query;
        }

        return $query->where('subcategory_id', $subcategory);
    }

    public function scopePrice($query, $price)
    {
        if (empty($price)) {
            return $query;
        } elseif (count($price) < 2) {
            if (array_key_exists('min', $price)) {
                return $query->where('price', '>=', $price['min']);
            } else {
                return $query->where('price', '<=', $price['max']);
            }
        }
        return $query->whereBetween('price', $price);
    }

    public function scopeCity($query, $city)
    {
        if (!$city) {
            return $query;
        }

        return $query->where('city_id', $city);
    }

    public function scopeSearch($query, $search)
    {
        if ($search === '') {
            return $query;
        }

        return $query->whereRaw("title_tsvector @@ websearch_to_tsquery(?)", [$search]);
    }

    public function deleteImages()
    {
        $images = $this->images()->get();
        foreach ($images as $image) {
            $image->delete();
        }
    }

    public function getOgMeta()
    {
        return [
            'title' => $this->title,
            'description' => Str::limit(strip_tags($this->description), 70),
            'type' => 'article',
            'image' => $this->getMainImage() ? asset($this->getMainImage()->thumbnail_path) : '',
            'url' => url("/post/$this->id/$this->slug")
        ];
    }

    public function getMainImage()
    {
        return $this->images->first();
    }

}
