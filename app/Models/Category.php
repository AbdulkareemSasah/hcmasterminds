<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'slug', 'description'];
    protected $fillable = [
        "name",
        "slug",
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function countPost()
    {
        return $this->posts()->count();
    }
}
