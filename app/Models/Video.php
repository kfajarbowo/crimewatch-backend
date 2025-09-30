<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'tiktok_embed_code',
        'author',
        'status',
        'views',
        'category_id'
    ];

    protected $casts = [
        'views' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getEmbedHtmlAttribute()
    {
        return $this->tiktok_embed_code;
    }
}