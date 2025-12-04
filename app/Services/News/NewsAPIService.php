<?php
namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class NewsAPIService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NEWSAPI_KEY');
    }

    public function fetch()
    {
        $todayDate = date('Y-m-d');
        $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&pageSize=10&from={$todayDate}&apiKey={$this->apiKey}");
        return $response->json()['articles'] ?? [];
    }
}
