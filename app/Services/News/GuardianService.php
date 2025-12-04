<?php 

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class GuardianService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GUARDIAN_API_KEY');
    }

    public function fetch()
    {
        $todayDate = date('Y-m-d');
        $response = Http::get("https://content.guardianapis.com/search?page=1&q=debate&from-date={$todayDate}&api-key={$this->apiKey}");

        return $response->json()['response']['results'] ?? [];
    }
}
