<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'category_id',
        'price',
        'stock_quantity',
        'is_seasonal',
        'is_new',
        'image_url'
    ];

    protected $casts = [
        'price' => 'float',
        'stock_quantity' => 'integer',
        'is_seasonal' => 'boolean',
        'is_new' => 'boolean'
    ];

    // Validation rules
    public static $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'short_description' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:category,category_id',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'is_seasonal' => 'required|boolean',
        'is_new' => 'required|boolean',
        'image_url' => 'required|string|url'
    ];

    // Relationship with category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Scope for new products
    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    // Scope for filtering by category and price range
    public function scopeFilter($query, $category = null, $minPrice = null, $maxPrice = null)
    {
        if ($category) {
            $query->where('category_id', $category);
        }

        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }
}
