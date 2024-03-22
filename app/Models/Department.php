<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Department extends Model
{
    use HasFactory, HasFilamentComments;
    use HasTranslations;
    public $translatable = [
        "title",
        "description",
        "content"
    ];

    protected $fillable = [
        "image",
        "title",
        "description",
        "content",
        "image",
        "published",
    ];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function videos(): HasMany
    {
        return $this
            ->hasMany(Video::class, 'model_id')
            ->where('model_type', $this->getMorphClass())
            ->latest();
    }
}
