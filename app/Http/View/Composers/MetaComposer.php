<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Content;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\View\View;

class MetaComposer
{
    public function compose(View $view)
    {
        //if its product url
        //product category, news, newsCategory, content, advertisement, slider, setting
        if (request()->segment(1) == 'product') { // Product Detail Page
            $product_slug = request()->segment(2);
            $product = Product::where('product_slug', $product_slug)->first();
            $meta_img = 'products/' . $product->image;

            $view->with([
                'meta_title' => $product->meta_title ?? '',
                'meta_description' => $product->meta_description ?? '',
                'meta_keyword' => $product->meta_keyword ?? '',
                'meta_img' => $meta_img ?? ''
            ]);
        } else if (request()->segment(1) == 'category') { //Category Page
            $category_slug = request()->segment(2);
            $category = Category::where('category_slug', $category_slug)->first();
            $meta_img = 'categories/' . $category->image;

            $view->with([
                'meta_title' => $category->meta_title ?? '',
                'meta_description' => $category->meta_description ?? '',
                'meta_keyword' => $category->meta_keyword ?? '',
                'meta_img' => $meta_img ?? ''
            ]);
        } else if (request()->segment(1) == 'news') {
            if (request()->segment(2) == '') { //News Page
                $setting = Setting::first();

                $meta_img = 'settings/' . $setting->site_logo;

                $view->with([
                    'meta_title' => $setting->meta_title ?? '',
                    'meta_description' => $setting->meta_description ?? '',
                    'meta_keyword' => $setting->meta_keyword ?? '',
                    'meta_img' => $meta_img ?? ''
                ]);
            } else  if (request()->segment(2) == 'category') { // News Category Page
                $category_url = request()->segment(3);
                $newsCategory = NewsCategory::where('category_url', $category_url)->first();
                $meta_img = 'newscategories/' . $newsCategory->featured_img;

                $view->with([
                    'meta_title' => $newsCategory->meta_title ?? '',
                    'meta_description' => $newsCategory->meta_description ?? '',
                    'meta_keyword' => $newsCategory->meta_keyword ?? '',
                    'meta_img' => $meta_img ?? ''
                ]);
            } else {
                $news_url = request()->segment(2);
                $news = News::where('news_url', $news_url)->first();
                $meta_img = 'news/' . $news->parallex_img;

                $view->with([
                    'meta_title' => $news->meta_title ?? '',
                    'meta_description' => $news->meta_description ?? '',
                    'meta_keyword' => $news->meta_keyword ?? '',
                    'meta_img' => $meta_img ?? ''
                ]);
            }
        } else {
            $content_url = request()->segment(1);
            $content = Content::where('content_url', $content_url)->first();
            $setting = Setting::first();

            $meta_content_img = ($content) ? 'contents/' . $content->featured_img : '';
            $meta_setting_img = ($setting) ? 'settings/' . $setting->site_logo : '';

            $view->with([
                'meta_title' => $content->meta_title ?? $setting->meta_title ?? '',
                'meta_description' => $content->meta_title ?? $setting->meta_description ?? '',
                'meta_keyword' => $content->meta_title ?? $setting->meta_keyword ?? '',
                'meta_img' => $meta_content_img ?? $meta_setting_img ?? ''
            ]);
        }
    }
}
