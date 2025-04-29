<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
    
    protected $fillable = ['name', 'description'];
    
    // Validation rules for creating/updating categories
    public static $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:1000'
    ];
    
    // Custom error messages for validation
    public static $messages = [
        'name.required' => 'Category name is required',
        'name.min' => 'Category name must be at least 3 characters',
        'name.max' => 'Category name cannot exceed 255 characters',
        'description.required' => 'Category description is required',
        'description.min' => 'Category description must be at least 10 characters',
        'description.max' => 'Category description cannot exceed 1000 characters'
    ];
    
    /**
     * Get all categories with optional eager loading
     */
    public static function getAll($with = [])
    {
        return self::with($with)->get();
    }
    
    /**
     * Get category by ID with optional eager loading
     */
    public static function getById($id, $with = [])
    {
        return self::with($with)->find($id);
    }
    
    /**
     * Create a new category
     */
    public static function createCategory(array $data)
    {
        return self::create($data);
    }
    
    /**
     * Relationship with products
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}