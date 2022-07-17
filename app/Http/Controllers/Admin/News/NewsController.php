<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Tag;
use App\Models\Writer;

class NewsController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "parallex_img";
        $files = $request->file('parallex_img');
        $this->imageUpload($request, $files, 'parallex-news', 'news', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'news/' . $image);
        }
        $news = News::orderBy('id', 'asc')->where('delete_status', '0')->get();
        //     foreach($news as $news){
        //     foreach ($news->category as $row) {
        //         dd($row->category_title);
        //     }
        // }
        return view('admin.list.news', compact('news'));
    }

    public function create()
    {
        $news = News::get();
        $categories = NewsCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $writers = Writer::where('publish_status', '1')->where('delete_status', '0')->get();
        $tags = Tag::where('publish_status', '1')->where('delete_status', '0')->get();

        return view('admin.form.news', compact('news', 'categories','writers','tags'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'news_title' => 'required',
            'news_date' => 'required',
            'news_category_id' => 'required',
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parallex_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news = new News();

        $news->news_title = request('news_title');
        $news->news_date = request('news_date');
        $news->news_excerpt = request('news_excerpt');
        $news->news_body = request('news_body');
        $news->news_url = request(str_slug($news->news_title));
        $news->external_link = request('external_link');
        $news->news_code = request('news_code');
        $news->meta_title = request('meta_title');
        $news->meta_keyword = request('meta_keyword');
        $news->meta_description = request('meta_description');
        $news->publish_status = request('publish_status');
        $news->featured_news = request('featured_news');

        $news->parallex_img = $request->session()->get('ajaximage');

        $news->save();

        $request->session()->forget('ajaximage');

        $cat_ids = request('news_category_id');
        $news->newscategory()->attach($cat_ids);

        $writer_ids = request('writer_id');
        $news->writer()->attach($writer_ids);

        $tag_ids = request('tag_id');
        $news->tag()->attach($tag_ids);

        return redirect('/ns-admin/news')->with('success', 'News created successfully.');
    }

    public function edit($id)
    {
        $news1 = News::where('id', $id)->first();
        $categories = NewsCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $writers = Writer::where('publish_status', '1')->where('delete_status', '0')->get();
        $tags = Tag::where('publish_status', '1')->where('delete_status', '0')->get();


        return view('admin.form.news', compact('news1', 'categories','writers','tags'));
    }

    public function update(Request $request, $id)
    {
        $news1 = News::where('id', $id)->first();

        $this->validate(request(), [
            'news_title' => 'required',
            'news_date' => 'required',
            'news_excerpt' => 'required',
            'news_body' => 'required',
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parallex_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = ([
            'news_title' => request('news_title'),
            'news_date' => request('news_date'),
            'news_body' => request('news_body'),
            'news_excerpt' => request('news_excerpt'),
            'news_url' => str_slug(request('news_title')),
            'external_link' => request('external_link'),
            'news_code' => request('news_code'),
            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
            'publish_status' => request('publish_status'),
            'featured_news' => request('featured_news'),
        ]);

        $file = request()->file('parallex_img');
        if ($file != null) {
            $image = $news1->parallex_img;
            @unlink('uploads/' . 'news/' . $image);
            $data1 = ([
                'parallex_img' => $request->session()->get('ajaximage'),
            ]);
            News::where('id', $id)->update($data1);
        }

        News::where('id', $id)->update($data);

        $cat_ids = request('news_category_id');
        $news1->newscategory()->sync($cat_ids);

        $writer_ids = request('writer_id');
        $news1->writer()->sync($writer_ids);

        $tag_ids = request('tag_id');
        $news1->tag()->sync($tag_ids);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/news')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::where('id', $id)->first();

        if (isset($news)) {
            $data = ([
                'delete_status' => '1',
            ]);

            News::where('id', $id)->update($data);
            return redirect('/ns-admin/news')->with('success', 'News deleted successfully.');
        }
        return redirect('/ns-admin/news')->with('error', 'News deletion failed.');
    }

    public function removeFeature($news)
    {
        $photo = News::where('featured_img', $news)->first();

        if (isset($photo)) {
            $image = $photo->featured_img;
            @unlink('uploads/' . 'news/' . $image);

            $data2 = (['featured_img' => null]);
            News::where('featured_img', $news)
                ->update($data2);
            return back()->with('success', 'Photo deletion Success.');
        }
        return back()->with('error', 'Photo deletion failed.');
    }

    public function removeParallex($news)
    {
        $photo = News::where('parallex_img', $news)->first();

        if (isset($photo)) {
            $image = $photo->parallex_img;
            @unlink('uploads/' . 'news/' . $image);

            $data2 = (['parallex_img' => null]);
            News::where('parallex_img', $news)
                ->update($data2);
            return back()->with('success', 'Photo deletion Success.');
        }
        return back()->with('error', 'Photo deletion failed.');
    }

}
