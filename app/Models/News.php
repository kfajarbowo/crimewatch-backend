<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


    public function getRenderedContentAttribute(): string
    {
        $html = (string) $this->content;

        // Handle "Baca Juga" shortcode
        $pattern = '/\[(baca[_-]juga)\s+url=\"([^\"]+)\"\](.*?)\[\/\1\]/is';
        $html = preg_replace_callback($pattern, function ($matches) {
            $url = e($matches[2]);
            $text = e(trim($matches[3]));

            return '<div class="my-4 p-4 rounded border border-red-200 bg-red-50">
                        <div class="text-red-700 font-semibold mb-1">Baca Juga:</div>
                        <a href="' . $url . '" class="text-gray-700 hover:text-red-700 underline">' . $text . '</a>
                    </div>';
        }, $html);

        // Handle "Quote" shortcode
        $quotePattern = '/\[quote(?:\s+author=\"([^\"]+)\")?\]\s*(.*?)\s*\[\/quote\]/is';
        $html = preg_replace_callback($quotePattern, function ($matches) {
            $author = isset($matches[1]) ? e(trim($matches[1])) : '';
            $quote = e(trim($matches[2]));

            // Split quote into lines if it contains actual newlines
            $lines = preg_split('/\r\n|\r|\n/', $quote);
            $quoteHtml = '';

            foreach ($lines as $line) {
                if (!empty(trim($line))) {
                    $quoteHtml .= '<p>' . trim($line) . '</p>';
                }
            }

            // Add author if provided
            if (!empty($author)) {
                $quoteHtml .= '<p>- ' . $author . '</p>';
            }

            return '<blockquote class="border-l-4 border-red-500 pl-6 my-4 italic text-gray-700">
                        ' . $quoteHtml . '
                    </blockquote>';
        }, $html);

        return $html;
    }
}