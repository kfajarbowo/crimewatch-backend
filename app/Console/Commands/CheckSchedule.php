<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Carbon\Carbon;

class CheckSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:check-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug which scheduled news are due and why others are not';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tz = config('app.timezone');
        $nowUtc = Carbon::now('UTC');
        $nowJakarta = Carbon::now('Asia/Jakarta');

        $this->info('App timezone: ' . ($tz ?? 'null'));
        $this->info('Now UTC: ' . $nowUtc->toDateTimeString());
        $this->info('Now Asia/Jakarta: ' . $nowJakarta->toDateTimeString());

        $all = News::orderByDesc('id')->take(20)->get(['id','title','status','published_at']);
        if ($all->isEmpty()) {
            $this->warn('No news records found.');
            return 0;
        }

        $scheduled = $all->where('status', 'scheduled');
        if ($scheduled->isEmpty()) {
            $this->warn('No news with status scheduled in the last 20 records.');
        }

        foreach ($scheduled as $news) {
            $publishedAt = $news->published_at ? $news->published_at->copy() : null;
            $publishedAtJakarta = $publishedAt ? $publishedAt->copy()->timezone('Asia/Jakarta') : null;
            $dueJakarta = $publishedAtJakarta ? $publishedAtJakarta->lessThanOrEqualTo($nowJakarta) : false;
            $this->line(sprintf(
                'ID:%d | %s | status:%s | published_at(raw):%s | published_at(WIB):%s | due(WIB):%s',
                $news->id,
                $news->title,
                $news->status,
                optional($publishedAt)->toDateTimeString() ?? 'null',
                optional($publishedAtJakarta)->toDateTimeString() ?? 'null',
                $dueJakarta ? 'YES' : 'NO'
            ));
        }

        $dueCountJakarta = News::where('status','scheduled')
            ->whereNotNull('published_at')
            ->where('published_at','<=',$nowJakarta)
            ->count();

        $this->info('Due scheduled count (query, WIB): ' . $dueCountJakarta);

        return 0;
    }
}
