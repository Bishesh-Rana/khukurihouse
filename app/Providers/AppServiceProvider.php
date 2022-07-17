<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\Brand;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\DeliveryAssign;
use Illuminate\Support\Facades\Auth;
use App\Models\SellerAddProductNotification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength('191');

        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        Paginator::useBootstrap();
        if(!$this->app->runningInConsole()){
            view()->composer('website.app', 'App\Http\View\Composers\MetaComposer');
            // view()->composer('website.app','App\Http\View\Composers\MetaBetaComposer'); //For Beta URL

            view()->composer('*', function ($view) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $cart_products = $cart->items;
                // dd($cart_products);

                $view->with('cart_products', $cart_products);
            });

            $setting = Setting::first();
            View::share('setting', $setting);

            $contents = Content::where('publish_status', '1')
            ->where('delete_status', '0')
            ->whereIn('show_on_menu', ['B', 'H'])
            ->orderBy('position', 'asc')
            ->with(['child' => function ($query) {
                $query->where('delete_status','0');
            }])
            ->get();
            View::share('contents', $contents);
            $brands = Brand::where('publish_status', '1')->where('delete_status', '0')->get();
            View::share('brands', $brands);

            $footerContents = Content::where('publish_status', '1')->where('delete_status', '0')->where('content_type', '!=', 'page')->whereIn('show_on_menu', ['B', 'F'])->get();
            // dd($footerContents);
            View::share('footerContents', $footerContents);

            $helpContents = Content::where('publish_status', '1')->where('delete_status', '0')->where('content_type', 'page')->get();
            View::share('helpContents', $helpContents);

            $categories = Category::home()->where('category_id', '0')->orderBy('position', 'asc')->limit(10)->get();
            View::share('categories', $categories);

            $new_subscribers = Subscriber::where('delete_status', '0')->orderBy('id', 'desc')->get();
            View::share('new_subscribers', $new_subscribers);

            $new_contacts = Contact::where('delete_status', '0')->where('view_status', '0')->orderBy('id', 'desc')->get();
            View::share('new_contacts', $new_contacts);

            $footer_categories = Category::home()->where('category_id', '0')->orderBy('category_name')->limit(10)->get();
            View::share('footer_categories', $footer_categories);
            // dd($footer_categories);

            // notification of seller newly added product
            view()->composer('admin.layouts.app', function ($view) {
                $all_notify = SellerAddProductNotification::join('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_seller_add_productnotifications.seller_id')->select('tbl_seller_add_productnotifications.created_at', 'tbl_sellers.company_name', 'tbl_seller_add_productnotifications.product_id')->where('tbl_seller_add_productnotifications.seen_status', '0')->get();
                $view->with('all_notify', $all_notify);
            });

            //  notification on delivery dashboard when admin assign orders to them
            view()->composer('delivery.layouts.app', function ($view) {
                $delivery_all_notify = DeliveryAssign::where('delivery_id', Auth::guard('delivery')->user()->id)
                    ->where('seen_status', '0')
                    ->select('ref_id', 'delivery_id', 'seen_status', 'created_at')
                    ->get();
                $view->with('delivery_all_notify', $delivery_all_notify);
            });

            $googlePlayAd = Advertisement::where('publish_status', '1')->where('delete_status', '0')->where('placement', 'google-play')->first();
            View::share('googlePlayAd',$googlePlayAd);

            // for Footer
            $singlecategories = Category::home()->where('category_id', '0')->orderBy('id', 'desc')->limit(5)->get();
            View::share('singlecategories', $singlecategories);

            $top5Products = Product::allStatus()->orderBy('view_count', 'desc')->where('best_rated', '1')->limit(5)->get();
            View::share('top5Products', $top5Products);

            $recentFooterProducts = Product::allStatus()->orderBy('created_at', 'desc')->limit(5)->get();
            View::share('recentFooterProducts', $recentFooterProducts);

            $footerdeals = Product::allStatus()->where('deal_end_date', '>', now())->where('on_deal', '1')->orderBy('updated_at','desc')->limit(5)->get();
            View::share('footerdeals', $footerdeals);

            $bestRatedfooterProducts = Product::allStatus()->latest()->where('best_rated', '1')->limit(5)->get();
            View::share('bestRatedfooterProducts', $bestRatedfooterProducts);

            $featuredfooterCategories = Category::home()->where('category_id', '0')->orderBy('id', 'desc')->limit(5)->get();
            View::share('featuredfooterCategories', $featuredfooterCategories);
        }



    }
}
