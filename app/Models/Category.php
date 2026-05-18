<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Sluggable, SoftDeletes;
    
    protected $fillable = [
        'title',   
        'slug'
    ];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'   
            ]
        ];
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}