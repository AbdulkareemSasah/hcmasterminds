<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Language extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ["label"];

    protected $fillable = [
        "label",
        "language",
        "default",
        "active",
    ];
    
}
