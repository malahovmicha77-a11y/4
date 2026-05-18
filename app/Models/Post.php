<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'image',
        'status'
    ];

    public $timestamps = true;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function getImage(){
        if (!$this->thumbnail) {
            return asset("no -image.png");
        }
        return asset("uploads/{;$this->thumabail}");
    }
}