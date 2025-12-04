<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class NYTimesService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NYT_API_KEY');
    }

    public function fetch()
    {   
        $todayDate = date('Ymd');
        $response = Http::get("https://api.nytimes.com/svc/search/v2/articlesearch.json?q=election&begin_date={$todayDate}&api-key={$this->apiKey}");
        return $response->json()['response']['docs'] ?? [];
    }
}
