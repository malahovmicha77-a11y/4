<?php

namespace App\Models;  

use Illuminate\Database\Eloquent\Model;
use Cviebrock\LaravelSluggable\Sluggable;  
class Post extends Model
{
    use Sluggable;  

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array  
    {
        return [
            'slug' => [
                'source' => 'title' 
            ]
        ];
    }
}