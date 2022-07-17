<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryRegistrationRequest extends FormRequest
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
            'first_name' => 'required|min:3|alpha',
            'last_name' => 'required|min:3|alpha',
            'company_name' =>'required|unique:tbl_deliveries',
            'company_country'=>'required',
            // 'company_state'=>'required',
            // 'company_city'=>'required',
            // 'company_address'=>'required',
            'company_phone'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|unique:tbl_deliveries',
            'email'=>'required|email|unique:tbl_deliveries',
            // 'company_website'=>'required',
            // 'company_offer'=>'required',
            // 'company_description'=>'required',
            'delivery_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            // 'username' => 'required|unique:tbl_deliveries',
            'zip_code' => 'required|regex:/\b\d{5}\b/',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ];
    }

    public function updateRules()
    {
        return [
            'first_name' => 'required|min:3|alpha',
            'last_name' => 'required|min:3|alpha',
            'company_name' => 'required|unique:tbl_deliveries,company_name,'.$this->delivery,
            'company_country'=>'required',
            'company_phone'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|unique:tbl_deliveries,company_phone,'.$this->delivery,
            'email'=>'required|email|unique:tbl_deliveries,email,'.$this->delivery,
            'delivery_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function rules(Request $request)
    {
        // $uri = $request->path();
        // dd($uri);
        if($request->is('ns-admin/deliveries/add'))
        {
            return $this->createRules();
        }
        elseif($request->is('ns-admin/deliveries/edit/*'))
        {
            return $this->updateRules();
        }
    }

    public function messages(){
        return [
            // 'username.required'     => 'Enter Delivery\'s username',
            'company_name.required'        => 'Please Enter Valid Company Name',
            'company_name.unique'          => 'The Company Name is already registered',
            'company_description.required' => 'Describe about the company',
            'zip_code.numeric'             => 'Zip Code must be in digits',
            'password.required_with'=> 'Password and password confirmation does not match'        
        ];
    }
}
