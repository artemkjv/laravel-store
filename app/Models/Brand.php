<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        "name", "content", "image"
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public static function popular() {
        return self::withCount('products')->orderByDesc('products_count')->limit(5)->get();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
