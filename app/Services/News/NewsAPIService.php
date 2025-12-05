<?php
namespace App\Services\News;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsAPIService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NEWSAPI_KEY');
    }

    public function fetch()
    {

        try {
            $todayDate = date('Y-m-d');
            // $todayDate = '2025-12-03'; // testing
            $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&pageSize=10&from={$todayDate}&apiKey={$this->apiKey}");
            
            // Handle HTTP-level errors
            if ($response->failed()) {
                Log::error("NewsAPI API request failed", [
                    'status' => $response->status(),
                    'body'   => $response->body()
                ]);
                return [];
            }

            return $response->json()['articles'] ?? [];
        }catch (\Throwable $e) {
            // Log unexpected exceptions
            Log::error("NewsAPI API error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }
}
