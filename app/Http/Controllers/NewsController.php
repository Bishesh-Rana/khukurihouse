<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news()
    {
        $content = Content::where('content_url', 'news')->first();
        if ($content == null) {
            abort(404);
        }

        if ($content != null) {
            $meta_title = $content->meta_title;
            $meta_description = $content->meta_description;
            $meta_keyword = $content->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $news = News::where('publish_status', '1')->where('delete_status', '0')->paginate(4);
        $newsCategories = NewsCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $recentNews = News::where('publish_status', '1')->where('delete_status', '0')->orderBy('id', 'desc')->limit(3)->get();
        $newsTags = Tag::where('publish_status', '1')->where('delete_status', '0')->limit(20)->get();

        return view('website.news', compact('news', 'newsCategories', 'recentNews', 'newsTags', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function newsByCategory($category_url)
    {
        $content = Content::where('content_url', 'news')->firstorFail();
        if ($content == null) {
            abort(404);
        }

        if ($content != null) {
            $meta_title = $content->meta_title;
            $meta_description = $content->meta_description;
            $meta_keyword = $content->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $news = NewsCategory::where('category_url', $category_url)->first()->news()->where('publish_status', '1')->where('delete_status', '0')->paginate(4);
        $newsCategories = NewsCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $recentNews = News::where('publish_status', '1')->where('delete_status', '0')->orderBy('id', 'desc')->limit(3)->get();
        $newsTags = Tag::where('publish_status', '1')->where('delete_status', '0')->limit(20)->get();

        return view('website.news', compact('news', 'newsCategories', 'recentNews', 'newsTags'));
    }

    public function newsByTag($tag_url)
    {
        $content = Content::where('content_url', 'news')->first();
        if ($content == null) {
            abort(404);
        }

        if ($content != null) {
            $meta_title = $content->meta_title;
            $meta_description = $content->meta_description;
            $meta_keyword = $content->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $news = Tag::where('tag_url', $tag_url)->first()->news()->where('publish_status', '1')->where('delete_status', '0')->paginate(4);
        $newsCategories = NewsCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $recentNews = News::where('publish_status', '1')->where('delete_status', '0')->orderBy('id', 'desc')->limit(3)->get();
        $newsTags = Tag::where('publish_status', '1')->where('delete_status', '0')->limit(20)->get();

        return view('website.news', compact('news', 'newsCategories', 'recentNews', 'newsTags', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showNews($news_url)
    {
        $news = News::where('news_url', $news_url)->firstorFail();

        if ($news != null) {
            $meta_title = $news->meta_title;
            $meta_description = $news->meta_description;
            $meta_keyword = $news->meta_keyword;
            $meta_img = 'news/' . $news->parallex_img;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
            $meta_img = '';
        }

        $newsCategories = NewsCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $recentNews = News::where('publish_status', '1')->where('delete_status', '0')->orderBy('id', 'desc')->limit(3)->get();
        $newsTags = Tag::where('publish_status', '1')->where('delete_status', '0')->limit(20)->get();

        // get previous news id
        $previous_id = News::where('id', '<', $news->id)->max('id');
        $previous_news = News::where('id',$previous_id)->first();

        // get next news id
        $next_id = News::where('id', '>', $news->id)->min('id');
        $next_news = News::where('id',$next_id)->first();

        return view('website.news-detail', compact('news', 'newsCategories', 'recentNews', 'newsTags', 'previous_news', 'next_news', 'meta_title', 'meta_description', 'meta_keyword', 'meta_img'));
    }

    public function comment()
    {
        return back()->with('success','Thanks for your comment.');
    }
}
