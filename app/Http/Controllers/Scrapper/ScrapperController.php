<?php

namespace App\Http\Controllers\Scrapper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ScrapHelper;
use Illuminate\Support\Facades\Log;

class ScrapperController extends Controller
{

    public function index()
    {
        // $millard = $this->millardNews();
        // $mwananchi = $this->mwananchiNews();
        $millard = $this->theCitizenNews();

        return view("scrapper", compact("millard"));
    }

    public function millardNews()
    {
        $scrapper = new ScrapHelper();

        $selectors = [
            "title" => ".entry-title a.p-url",
            "time" => "time.date.published",
            "author" => "span.meta-author a",
            "link" => "entry-title a.p-url",
            "image" => "div.p-featured a.p-flink img.featured-img",
            "summary" => "p.entry-summary",
        ];

        $data = $scrapper->website_scrapper("https://millardayo.com/?s=siasa'", $selectors);

        Log::info('Scraped Data:', $data);


        return $data;
    }

    public function theCitizenNews()
    {
        $scrapper = new ScrapHelper();


        $selectors = [
            "title" => "h3.teaser-image-large_title",
            "summary" => "p.teaser-image-large_paragraph",
            "time" => "span.date",
            "link" => "a.teaser-image-large",
            "image" => "figure.lazy-img-container img",
            "topic" => "span.article-topic.article-metadata_topic"
        ];

        $data = $scrapper->website_scrapper("https://www.thecitizen.co.tz/tanzania'", $selectors);

        Log::info('Scraped Data:', $data);


        return $data;
    }
    public function mwananchiNews()
    {
        $scrapper = new ScrapHelper();

        $selectors = [
            "title" => "h3.teaser-image-large_title",
            "summary" => "p.teaser-image-large_paragraph",
            "time" => "span.date",
            "link" => "a.teaser-image-large",
            "image" => "figure.lazy-img-container img.blk-img"
        ];

        $data = $scrapper->website_scrapper("https://mwananchi.co.tz/mw/habari/kitaifa'", $selectors);

        Log::info('Scraped Data:', $data);


        return $data;
    }
    public function jamiiForums() {}
}
