<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Chapter extends Model
{
    use HasFactory;
    use HasTranslations, HasFilamentComments;
    public $translatable = [
        "title",
        "description",
        "content"
    ];

    protected $fillable = [
        "course_id",
        "image",
        "title",
        "description",
        "content",
        "image",
        "published",
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function videos(): HasMany
    {
        return $this
            ->hasMany(Video::class, 'model_id')
            ->where('model_type', $this->getMorphClass())
            ->latest();
    }
}
