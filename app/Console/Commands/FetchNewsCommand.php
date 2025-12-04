<?php

namespace App\Console\Commands;

use App\Jobs\FetchNewsJob;
use App\Models\Article;
use App\Services\NewsAggregator;
use Illuminate\Console\Command;

class FetchNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news from all sources';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $sources = ['guardian', 'nyt', 'newsapi'];
        foreach ($sources as $source) {
            FetchNewsJob::dispatch($source);
            $this->info("Job dispatched: " . $source);
        }
        
        $this->info("All jobs dispatched successfully.");
    }
}
