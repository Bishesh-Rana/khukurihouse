<?php

namespace App\Http\Traits;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

trait ChatTrait{

    public function allMailList(){

        $mail_list = Message::join('tbl_customers', 'tbl_customers.id', '=', 'tbl_messages.customer_id')
        ->where('tbl_messages.owner_id', Auth::guard('seller')->user()->id)
        ->where('tbl_messages.send_by', 'customer')
        ->select('tbl_messages.customer_id as customer_id','tbl_customers.name', 'tbl_messages.message', 'tbl_messages.seen_status', 'tbl_messages.created_at', 'tbl_customers.image')
        ->orderBy('tbl_messages.id', 'desc')
        ->groupBy('customer_id')
        ->get();
        $pending_count = 0;
        foreach($mail_list as $row){
            if($row->seen_status == '0'){
                $pending_count+=1;
            }

            $unseen_count = Message::where('send_by', 'customer')
            ->where('customer_id', $row->customer_id)
            ->where('seen_status', '0')->get()->count();
            $row->setAttribute('unseen_count',$unseen_count);
        }

        $data = compact('mail_list', 'pending_count');
        return $data;
    }

}
