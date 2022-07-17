<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */



    public function createRules()
    {
        return [
            'product_name' => 'required',
            // 'product_name' => 'required|unique:tbl_products,product_name',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'sub_child_category_id' => 'required',
            'product_code' => 'required|unique:tbl_products,product_code',
            // 'product_brand' => 'required',
            // 'product_model' => 'required',
            'product_original_price' => 'nullable',
            // 'product_compare_price' => 'required',
            // 'product_highlights' => 'required',
            // 'product_warranty_type' => 'required',
            // 'product_whats_on_box' => 'required',
            // 'product_package_weight' => 'required',
            // 'product_key_features' => 'required',
            // 'deliveryType' => 'required|in:' . implode(',',Product::DELIVERYTYPE),
            // 'deal_end_date' => 'exclude_if:on_deal,false|required|date',
        ];
    }


    public function updateRules()
    {
        return [
            'product_name' => 'required',
            // 'product_name' => 'required|unique:tbl_products,product_name,'.$this->product,
            // 'sub_child_category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'product_code' => 'required|unique:tbl_products,product_code,' . $this->product,
            // 'product_brand' => 'required',
            'product_model' => 'required',
            'product_original_price' => 'nullable',
            // 'product_compare_price' => 'required',
            // 'product_highlights' => 'required',
            // 'product_warranty_type' => 'required',
            // 'product_whats_on_box' => 'required',
            // 'product_package_weight' => 'required',
            // 'product_key_features' => 'required',
            // 'deal_end_date' => 'exclude_if:on_deal,false|required|date',
        ];
    }

    public function rules(Request $request)
    {
        if ($request->is('ns-admin/products/add')) {
            return $this->createRules();
        } elseif ($request->is('ns-admin/products/edit/*')) {
            return $this->updateRules();
        }
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Product name is required !',
            'product_name.unique' => 'Product name already taken !',
            'sub_child_category_id.required' => 'Product Category required!',
            'product_code.required' => 'Product Code name is required !',
            'product_code.unique' => 'Product Code already taken !',
            'product_brand.required' => 'Product Brand name is required !',
            'product_model.required' => 'Product Model is required !',
            'product_original_price.required' => 'Product Original Price is required !',
            'product_compare_price.required' => 'Product Compare Price is required !',
            'product_highlights.required' => 'Product Highlights is required !',
            'product_warranty_type.required' => 'Product Warrenty Type is required !',
            'product_whats_on_box.required' => 'Product Whats On Box is required !',
            'product_package_weight.required' => 'Product Package Weight is required !',
            'product_key_features.required' => 'Product Key Features is required !',
        ];
    }
}
