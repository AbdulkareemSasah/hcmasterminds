<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasFactory, HasFilamentComments;
    use HasTranslations;

    public $translatable = [
        "title",
        "description",
        "content"
    ];

    protected $fillable = [
        "department_id",
        "image",
        "title",
        "description",
        "content",
        "image",
        "published",
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,  "department_id");
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function videos(): HasMany
    {
        return $this
            ->hasMany(Video::class, 'model_id')
            ->where('model_type', $this->getMorphClass())
            ->latest();
    }
}
