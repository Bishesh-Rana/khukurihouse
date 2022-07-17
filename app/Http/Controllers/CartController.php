<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DeliverySetting;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\StockCalculate;
use App\Rules\CheckStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class CartController extends Controller {
    public function getAddToCart( Request $request, $id ) {
        $product = Product::findOrFail( $id );

        $product->setAttribute( 'quantity', $request->qty );
        // $product->setAttribute( 'delivery_charge', $request->delivery_charge );

        $oldCart = Session::has( 'cart' ) ? Session::get( 'cart' ) : null;

        $cart = new Cart( $oldCart );
        $cart->add( $product, $product->id );

        $request->session()->put( 'cart', $cart );

        return back()->with( 'success', 'Item added to cart.' );
    }

    public function getCart( Request $request ) {
        $setting = Setting::first();
        if ( $setting != null ) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        return view( 'front.cart', compact( 'meta_title', 'meta_description', 'meta_keyword' ) );
    }

    public function getStockErrorCart( $product ) {
        return redirect( '/cart' )->with( 'status', 'Sorry! Product ' . $product . ' is out of stock.' );
    }

    public function getProductErrorCart( $product ) {
        return redirect( '/cart' )->with( 'status', 'Sorry! Product ' . $product . ' does not exist.' );
    }

    public function updateAddToCart( Request $request ) {
        Session::forget( 'cart' );

        foreach ( $request->id as $key => $id ) {

            $product = Product::with( 'stock' )->findOrFail( $id );
            $product->setAttribute( 'quantity', $request->qty[ $key ] );

            $oldCart = Session::has( 'cart' ) ? Session::get( 'cart' ) : null;
            $cart = new Cart( $oldCart );
            $cart->add( $product, $product->id );

            $request->session()->put( 'cart', $cart );
        }

        return back()->with( 'success', 'Cart Updated.' );
    }

    public function getRemoveItem( $id ) {
        $oldCart = Session::has( 'cart' ) ? Session::get( 'cart' ) : null;
        $cart = new Cart( $oldCart );
        $cart->removeItem( $id );

        if ( count( $cart->items ) > 0 ) {
            Session::put( 'cart', $cart );
        } else {
            Session::forget( 'cart' );
        }
        return back()->with( 'success', 'Item removed from cart.' );
    }

    public function getCheckout() {
        $client = new Client();
        $integrator = [];

        $response = $client->get("https://algxpress.com/api/integrator",[
            'headers' => [
                'Content-Type'      => 'application/json'
            ]]);
            // dd($response);
            $integrator = json_decode($response->getBody()->getContents())->data;
            // dd($integrator);
        // if ( Auth::guard( 'web' )->check() ) {
            $countries = DB::table( 'countries' )->select( 'countries.*' )->get();
            $districts = DB::table( 'districts' )->select( 'districts.*' )->get();

            if ( !Session::has( 'cart' ) ) {
                return redirect()->route( 'product.cart' );
            }

            $oldCart = Session::get( 'cart' );
            $cart = new Cart( $oldCart );
            $cart_products = $cart->items;

            // Verifying Stock
            foreach ( $cart_products as $product ) {
                $stock_qty = $product[ 'item' ]->fresh()->stock->remaining_stock;
                //refreshing model
                if ( $product[ 'qty' ] > $stock_qty )
                return redirect()->route( 'product.cart' )->with( 'error-message', 'No ' . $product[ 'item' ]->product_name . ' remaining in Stock.' );
            }

            // Checking if product exists
            foreach ( $cart_products as $product ) {
                if ( $product[ 'item' ]->fresh()->publish_status == 0 || $product[ 'item' ]->fresh()->delete_status == 1) {
                    return redirect()->route( 'product.cart' )->with( 'error-message', 'Product ' . $product[ 'item' ]->product_name . ' does not exist.' );
                }
            }


            return view( 'front.checkout', compact( 'countries','districts','integrator' ) );
        // } else {
        //     return redirect()->route('customer.login' )->with( 'error-message', 'Please login to continue' );
        // }
    }
}
