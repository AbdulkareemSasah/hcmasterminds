<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Lesson extends Model
{
    use HasFactory, HasTranslations, HasFilamentComments;
    public $translatable = [
        "title",
        "description",
        "content"
    ];

    protected $fillable = [
        "chapter_id",
        "image",
        "title",
        "description",
        "content",
        "image",
        "video",
        "published",
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, "chapter_id");
    }

    public function videos(): HasMany
    {
        return $this
            ->hasMany(Video::class, 'model_id')
            ->where('model_type', $this->getMorphClass())
            ->latest();
    }
}
