<?php
namespace App\Services;

use App\Models\Article;
use App\Services\News\GuardianService;
use App\Services\News\NYTimesService;
use App\Services\News\NewsAPIService;

class NewsAggregator
{
    // get all source data in one function
    public function fetchAll()
    {
        $guardian = (new GuardianService())->fetch();
        $nyt = (new NYTimesService())->fetch();
        $newsApi = (new NewsAPIService())->fetch();

        return [
            'guardian' => $guardian,
            'nytimes' => $nyt,
            'newsapi' => $newsApi
        ];
    }

    // get data via source
    public function fetchFromSource($source)
    {
        if ($source === 'guardian') {
            return $this->fetchGuardian();
        }

        if ($source === 'newsapi') {
            return $this->fetchNewsApi();
        }

        if ($source === 'nyt') {
            return $this->fetchNYT();
        }
    }

    private function fetchGuardian()
    {
        $guardian = (new GuardianService())->fetch();

        foreach ($guardian as $a) {
            Article::updateOrCreate(
                ['url' => $a['webUrl'] ?? null],
                [
                    'source' => 'guardian',
                    'author' => $a['sectionName'] ?? null,
                    'title' => $a['webTitle'] ?? null,
                    'description' => $a['webTitle'] ?? null,
                    'category' => $a['pillarName'] ?? null,
                    'image_url' => null,
                    'published_at' => ($a['webPublicationDate']) ? date('Y-m-d H:i:s', strtotime($a['webPublicationDate'])) : null
                ]
            );
        }
    }

    private function fetchNYT()
    {
        $nyt = (new NYTimesService())->fetch();

        foreach ($nyt as $a) {
            Article::updateOrCreate(
                ['url' => $a['web_url'] ?? null],
                [
                    'source' => 'newsapi',
                    'author' => $a['byline']['original'] ?? null,
                    'title' => $a['headline']['main'] ?? null,
                    'description' => $a['snippet'] ?? null,
                    'category' => $a['news_desk'] ?? null,
                    'image_url' => $a['multimedia']['default']['url'] ?? null,
                    'published_at' => ($a['pub_date']) ? date('Y-m-d H:i:s', strtotime($a['pub_date'])) : null
                ]
            );
        }
    }

    private function fetchNewsApi()
    {
        $newsApi = (new NewsAPIService())->fetch();

        foreach ($newsApi as $a) {
            Article::updateOrCreate(
                ['url' => $a['url'] ?? null],
                [
                    'source' => 'nyt',
                    'author' => $a['author'] ?? null,
                    'title' => $a['title'] ?? null,
                    'description' => $a['description'] ?? null,
                    'category' => $a['source']['name'] ?? null,
                    'image_url' => $a['urlToImage'] ?? null,
                    'published_at' => ($a['publishedAt']) ? date('Y-m-d H:i:s', strtotime($a['publishedAt'])) : null
                ]
            );
        }
    }
}
