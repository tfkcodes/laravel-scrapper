<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ScrapHelper
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function website_scrapper($link, $selectors = [])
    {
        $data = [];

        $response = $this->client->get($link);
        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);

        foreach ($selectors as $key => $selector) {
            $data[$key] = $this->scrapeAttribute($crawler, $selector, $key);
        }

        $data['link'] = $link;



        return $data;
    }

    private function scrapeAttribute(Crawler $crawler, $selector, $attribute)
    {
        $results = [];

        $elements = $crawler->filter($selector);

        $elements->each(function ($node) use (&$results, $attribute) {
            switch ($attribute) {
                case 'image':
                    $results[] = $node->attr('src');
                    break;
                case 'link':
                case 'readMoreLink':
                    $results[] = $node->attr('href');
                    break;
                default:
                    $results[] = trim($node->text());
                    break;
            }
        });

        return count($results) > 0 ? $results : null;
    }
}
