<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Feeds;
use App\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


     public function feed()
     {
         $rss = Auth::user()->media->pluck('rss');

         $articles = [];

         if ($rss->count()) {
             $feed = Feeds::make($rss->toArray());

             $items = $feed->get_items();

             foreach ($items as $item) {
                 $articles[] = Article::create($item);
             }
         }

         return view('feed')->with(compact('articles'));
     }
}
