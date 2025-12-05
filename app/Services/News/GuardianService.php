<?php 

namespace App\Services\News;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GuardianService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GUARDIAN_API_KEY');
    }

    public function fetch()
    {
        try {
            $todayDate = date('Y-m-d');
            // $todayDate = '2025-12-02'; // testing
            $response = Http::get("https://content.guardianapis.com/search?page=1&q=debate&from-date={$todayDate}&api-key={$this->apiKey}");

            // Handle HTTP-level errors
            if ($response->failed()) {
                Log::error("Guardian API request failed", [
                    'status' => $response->status(),
                    'body'   => $response->body()
                ]);
                return [];
            }

            return $response->json()['response']['results'] ?? [];
        }catch (\Throwable $e) {
            // Log unexpected exceptions
            Log::error("Guardian API error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }
}
