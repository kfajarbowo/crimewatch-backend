<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author',
        'location',
        'published_at',
        'status',
        'tags',
        'category_id',
        'is_featured',
        'views'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/placeholder.jpg');
    }


    public function getMetaDescriptionAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 160);
    }

    public function getMetaKeywordsAttribute(): string
    {
        $keywords = [];
        
        // Add tags if available
        if ($this->tags) {
            $keywords[] = $this->tags;
        }
        
        // Add category name
        if ($this->category) {
            $keywords[] = $this->category->name;
        }
        
        // Add location if available
        if ($this->location) {
            $keywords[] = $this->location;
        }
        
        // Add default keywords
        $keywords[] = 'berita kriminal';
        $keywords[] = 'kejahatan';
        
        return implode(', ', array_unique($keywords));
    }

    public function getRelatedNewsAttribute()
    {
        return News::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();
    }

    public function getWordCountAttribute(): int
    {
        return str_word_count(strip_tags($this->content));
    }

    public function getInternalLinksAttribute()
    {
        
        return [];
    }
}