<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id',

        'title',
        'price',
        'description',
        'category_id',
        'image',
        'rating',

        'created_at',
        'updated_at',
    ];

    public function getRatingAttribute($value)
    {
        return json_decode($value, true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
