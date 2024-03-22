<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, HasFilamentComments;
    use HasTranslations;

    public $translatable = ["title", "slug", "description", "content"];
    protected $fillable = [
        "user_id",
        "category_id",
        "title",
        "slug",
        "description",
        "content",
        "published",
        "featured",
        "image",
    ];
    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
