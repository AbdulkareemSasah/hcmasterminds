<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
    use HasFactory;
    use HasTranslations, HasFilamentComments;
    public $translatable = ["name", "translations", "description"];
    protected $fillable = [
        'model_id',
        'model_type',
        'name',
        'description',
        'attachment',
        'type',
        'translations'
    ];
    public function model(): BelongsTo
    {
        return $this->morphTo();
    }
}
