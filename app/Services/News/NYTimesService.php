<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NYTimesService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NYT_API_KEY');
    }

    public function fetch()
    {   
        try {
            $todayDate = date('Ymd');
            // $todayDate = '20251202'; // testing
            $response = Http::get("https://api.nytimes.com/svc/search/v2/articlesearch.json?q=election&begin_date={$todayDate}&api-key={$this->apiKey}");
            
            // Handle HTTP-level errors
            if ($response->failed()) {
                Log::error("NYTimes API request failed", [
                    'status' => $response->status(),
                    'body'   => $response->body()
                ]);
                return [];
            }

            return $response->json()['response']['docs'] ?? [];
        }catch (\Throwable $e) {
            // Log unexpected exceptions
            Log::error("NYTimes API error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }
}
