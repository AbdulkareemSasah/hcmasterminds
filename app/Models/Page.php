<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasFilamentComments;
    use HasTranslations;

    public $translatable = ["title", "slug", "description", "content"];
    protected $fillable = [
        "title",
        "slug",
        "description",
        "content",
        "published",
        "image",
        "has_nav_item",
        "name_in_nav",
    ];
}
