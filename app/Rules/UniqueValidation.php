<?php

namespace App\Rules;

use App\Seller;
use Illuminate\Validation\Rule;


class UniqueValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
       
      
        // $list_company_name = Seller::where('delete_status', '0')->where('publish_status', '1')->select('company_name')->get();
      
        // foreach($list_company_name as $row){
        //         if($row->company_name == $value){
        //             return false;
        //         }
        //         else
        //     return true;
        
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Company Name Already Taken !!!';
    }
}
