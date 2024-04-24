<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use willvincent\Feeds\Facades\FeedsFacade;

class NewsFeedController extends Controller
{
    public function index()
    {
        $feed = FeedsFacade::make('https://vnexpress.net/rss/the-thao.rss');
        $data = array(
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items(),
        );

        return view('newsFeed', $data);
    }
}
