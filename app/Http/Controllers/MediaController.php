<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Article;
use App\Category;
use Auth;
use Feeds;
use App\Http\Requests\ReadArticleRequest;
use App\Http\Requests\MediaRequest;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['read', 'subscribe', 'unsubscribe']);
    }

    public function add(MediaRequest $request)
    {
        $media = Media::create($request->only('title', 'rss'));
        $string = preg_replace('/\s+/', '', $request->categories);
        $categories = explode(',', $string);

        foreach ($categories as $category) {
            $media->categories()->sync(Category::firstOrCreate([
                'title' => $category
            ]), false);
        }

        $media->subscribers()->sync(Auth::id(), false);

        return redirect()->route('feed');
    }

    public function index()
    {
        $media = Media::with('subscribers', 'categories')
            ->get()
            ->sortByDesc(function($media) {
                return $media->subscribers->count();
            });

        return view('media.media')->with(compact('media'));
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $media = Media::with('subscribers', 'categories')
            ->where('title', 'ilike', '%' . $search . '%')
            ->orWhereHas('categories', function ($q) use ($search) {
                $q->where('categories.title', 'ilike', '%' . $search . '%');
            })
            ->get()
            ->sortByDesc(function($media) {
                return $media->subscribers->count();
            });

        return view('media.media')->with(compact('media', 'search'));
    }

    public function feed(Media $media)
    {
        $feed = Feeds::make($media->rss);

        $items = $feed->get_items();

        if (Auth::check()) {
            $categories = $media->categories->pluck('title')->implode(',');
            Auth::user()->read($categories);
        }

        $articles = [];
        foreach ($items as $item) {
            $articles[] = Article::create($item);
        }

        return view('media.feed')->with(compact('articles', 'media'));
    }

    public function suggestions()
    {
        $interests = Auth::user()->interests();
        $media = Media::with('subscribers', 'categories');

        foreach($interests as $interest) {
            $media = $media->orWhereHas('categories', function ($query) use ($interest) {
                $query->where('title', 'ilike', '%' . $interest->title . '%');
            });
        }

        $media = $media->get()->sortByDesc(function($m) {
            return $m->subscribers->count();
        });

        return view('media.media')->with(compact('media'));
    }

    public function subscribe(Media $media)
    {
        Auth::user()->subscribe($media);

        return redirect()->back();
    }

    public function unsubscribe(Media $media)
    {
        Auth::user()->unsubscribe($media);

        return redirect()->back();
    }

    public function read(ReadArticleRequest $request)
    {
        Auth::user()->read($request->tags);

        return redirect($request->link);
    }
}
