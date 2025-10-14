<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Carbon\Carbon;

class PublishNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled news articles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        
        // Find all scheduled news that should be published now or earlier
        $scheduledNews = News::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->get();

        if ($scheduledNews->isEmpty()) {
            $this->info('No scheduled news to publish at this time.');
            return 0;
        }

        $publishedCount = 0;

        foreach ($scheduledNews as $news) {
            $news->update([
                'status' => 'published'
            ]);

            $publishedCount++;
            $this->info("Published: {$news->title} (ID: {$news->id})");
        }

        $this->info("Successfully published {$publishedCount} scheduled news articles.");
        
        return 0;
    }
}
