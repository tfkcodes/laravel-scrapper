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
        $millard = $this->millardNews();

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

    public function gazetiLaDuniaNews() {}
    public function jamiiForums() {}
}
