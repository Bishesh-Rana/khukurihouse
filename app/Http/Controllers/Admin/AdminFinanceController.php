<?php

namespace App\Http\Controllers\Admin;

use App\Models\General;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Statement;
use Carbon\Carbon;
use App\Models\SalesReturn;
use App\Models\TransactionOverview;
use Illuminate\Http\Request;
use App\Models\ReturnTransactionOverview;
use App\Http\Controllers\Controller;
use App\Http\Traits\FinancialStatementTrait;
use Illuminate\Database\Eloquent\Collection;

class AdminFinanceController extends Controller
{
    use FinancialStatementTrait;
    private $order_transaction_overview, $refund_transaction_overview, $statement, $order_item_charges, $return_item_charges;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $generate_statement = false;
        $previous_month = Statement::latest('id')->first();
        // dd($previous_month);
        if (isset($previous_month)) {
            if ($previous_month->month + 1 == date('m')) {
                $generate_statement = false;
            } else {
                $generate_statement = true;
            }
        } else {
            $generate_statement = true;
        }


        $sellers = Seller::parentSeller()->select('id', 'company_name')->get();
        $years = Statement::groupBy('year')->get('year');
        // dd($years);
        $statements = new Collection;
        return view('admin.list.finance_index_page', compact('generate_statement', 'sellers', 'years', 'statements'));
    }

    public function adminGenerateMonthlyStatement(Request $request)
    {


        $reqest_month = date("m", strtotime("-1 months"));
        // $reqest_month = $current_month;
        // dd($reqest_month);

        // $sellers = Seller::where('publish_status', '1')->where('delete_status', '0')->get();
        $sellers = Seller::parentSeller()->get();
        // dd($sellers);
        foreach ($sellers as $seller) {
            $this->order_item_charges = 0;
            $this->return_item_charges = 0;
            $this->order_transaction_overview = new TransactionOverview;
            $this->refund_transaction_overview = new ReturnTransactionOverview;
            $this->statement = new Statement;
            // dd($seller->id);
            // while ($seller->id > '0') {

            //To get the transaction overview of previous month
            $order_transaction_overviews = $this->order_transaction_overview->orderTransactionOverviews($seller, $reqest_month);
            // dump($order_transaction_overviews);
            //To get the products of transaction overview of previous month
            $order_tansaction_overview_products = $this->order_transaction_overview->orderTransactionOverviewProducts($seller, $reqest_month);
            // dump($order_tansaction_overview_products);
            $refund_transaction_overviews = $this->refund_transaction_overview->refundTransactionOverviews($seller, $reqest_month);
            $refund_transaction_overview_products = $this->refund_transaction_overview->refundTransactionOverviewProducts($seller, $reqest_month);

            foreach ($order_tansaction_overview_products as $key => $row) {
                $orders_item = Order::where('ref_id', $row->order_number)->where('product_id', $row->product_id)->first();
                // dd($orders_item);
                $this->order_item_charges += $row->product_price * $orders_item->quantity;
            }

            foreach ($refund_transaction_overview_products as $key => $row) {
                $sales_return = SalesReturn::where('ref_id', $row->order_number)->where('product_id', $row->product_id)->first();
                $this->return_item_charges += $row->product_price * $sales_return->quantity;
            }

            $previous_month = Statement::where('seller_id', $seller->id)->latest('id')->first();
            //yo optimize gari hala
            if (isset($previous_month)) {
                $this->statement->seller_id = $seller->id;
                $this->statement->month = $reqest_month;
                $this->statement->year = date('Y');
                $this->statement->opening_balance = $previous_month->closing_balance;

                $this->statement->order_item_charge = $this->order_item_charges;
                $this->statement->order_eshopping_fee = $order_transaction_overviews->sum('amount');
                $this->statement->order_payment_fee = $order_transaction_overviews->where('transaction_type', 'payment_fee')->sum('amount');
                $this->statement->order_commission_fee = $order_transaction_overviews->where('transaction_type', 'commission_fee')->sum('amount');
                $this->statement->order_shipping_fee = $order_transaction_overviews->where('transaction_type', 'shipping_fee')->sum('amount');
                $this->statement->order_penalties = 0;
                $this->statement->order_vat = $order_transaction_overviews->sum('vat');
                $this->statement->order_subtotal = $this->statement->order_item_charge - $this->statement->order_eshopping_fee - $this->statement->order_vat;

                $this->statement->refund_item_charge = $this->return_item_charges;
                $this->statement->refund_eshopping_fee = $refund_transaction_overviews->sum('amount');
                $this->statement->refund_payment_fee_credit = $refund_transaction_overviews->where('transaction_type', 'payment_fee_credit')->sum('amount');
                $this->statement->refund_reversal_commission_fee = $refund_transaction_overviews->where('transaction_type', 'reversal_commission_fee')->sum('amount');
                $this->statement->refund_penalties = 0;
                $this->statement->refund_vat = $refund_transaction_overviews->sum('vat');
                $this->statement->refund_subtotal = -$this->statement->refund_item_charge + $this->statement->refund_eshopping_fee + $this->statement->refund_vat;

                $this->statement->payout = 0;

                $this->statement->closing_balance = ($this->statement->opening_balance + $this->statement->order_subtotal) + $this->statement->refund_subtotal;
                // dd($this->statement->closing_balance);
                $finalStatement = $this->insertFinancialStatement($this->statement);
                // dd($finalStatement);
                // return back()->with('success', 'Previous Month Statement Generated Successfully!');
            } else {
                $this->statement->seller_id = $seller->id;
                $this->statement->month = $reqest_month;
                $this->statement->year = date('Y');
                $this->statement->opening_balance = 0;

                $this->statement->order_item_charge = $this->order_item_charges;
                $this->statement->order_eshopping_fee = $order_transaction_overviews->sum('amount');
                $this->statement->order_payment_fee = $order_transaction_overviews->where('transaction_type', 'payment_fee')->sum('amount');
                $this->statement->order_commission_fee = $order_transaction_overviews->where('transaction_type', 'commission_fee')->sum('amount');
                $this->statement->order_shipping_fee = $order_transaction_overviews->where('transaction_type', 'shipping_fee')->sum('amount');
                $this->statement->order_penalties = 0;
                $this->statement->order_vat = $order_transaction_overviews->sum('vat');
                $this->statement->order_subtotal = $this->statement->order_item_charge - $this->statement->order_eshopping_fee - $this->statement->order_vat;

                $this->statement->refund_item_charge = $this->return_item_charges;
                $this->statement->refund_eshopping_fee = $refund_transaction_overviews->sum('amount');
                $this->statement->refund_payment_fee_credit = $refund_transaction_overviews->where('transaction_type', 'payment_fee_credit')->sum('amount');
                $this->statement->refund_reversal_commission_fee = $refund_transaction_overviews->where('transaction_type', 'reversal_commission_fee')->sum('amount');
                $this->statement->refund_penalties = 0;
                $this->statement->refund_vat = $refund_transaction_overviews->sum('vat');
                $this->statement->refund_subtotal = -$this->statement->refund_item_charge + $this->statement->refund_eshopping_fee + $this->statement->refund_vat;

                $this->statement->payout = 0;

                $this->statement->closing_balance = $this->statement->order_subtotal + $this->statement->refund_subtotal;

                $finalStatement = $this->insertFinancialStatement($this->statement);
                // $this->order_transaction_overview = null;
                // dd($finalStatement);
                // return back()->with('success', 'Previous Month Statement Generated Successfully!');
            }
            // }
        }
        return back()->with('success', 'Previous Month Statement Generated Successfully!');
    }

    public function sellerMonthlyStatement(Request $request)
    {
        $date = explode("-", $request->month);

        $year = $date[0];
        $month = $date[1];

        $generate_statement = false;
        $previous_month = Statement::latest('id')->first();
        if (isset($previous_month)) {
            if ($previous_month->month + 1 == date('m')) {
                $generate_statement = false;
            } else {
                $generate_statement = true;
            }
        } else {
            $generate_statement = true;
        }

        $sellers = Seller::where('publish_status', '1')->where('delete_status', '0')->select('id', 'company_name')->get();
        $years = Statement::groupBy('year')->get('year');

        // $year = (int) $request->year;
        // $month = (int) $request->month;
        $seller_name = (int) $request->sellerName;

        $statements = Statement::where('seller_id', $seller_name)->where('publish_status', '1')->where('delete_status', '0')
            ->when($year, function ($query, $year) {
                return $query->where("year", $year);
            })
            ->when($month, function ($query, $month) {
                return $query->where("month", $month);
            })
            ->get();

        // to be continue from ajax list after seller filter for the monthly statement
        return view('admin.list.ajaxlist.finance_index_page', compact('statements'));
    }

    public function financialOverviewByMonth($id)
    {
        $finance = Statement::find($id);
        // dd($finance);
        return view('admin.pages.finance', compact('finance'));
    }

    public function sellerTransactionOverview()
    {
        $transactions = new Collection();
        $sellers = Seller::parentSeller()->get();
        $years = Statement::groupBy('year')->get('year');

        return view('admin.list.transaction_overview', compact('transactions', 'years', 'sellers'));
    }

    public function transactionOverview($transaction_type, $year, $month, $seller_id)
    {
        $from = Carbon::create($year, $month)->firstOfMonth();
        $to = Carbon::create($year, $month)->lastOfMonth();

        $enumoption = General::getEnumValues('tbl_transaction_overviews', 'transaction_type');
        if (array_key_exists($transaction_type, $enumoption)) {
            $transactions = TransactionOverview::where('seller_id', $seller_id)
                ->where('transaction_type', $transaction_type)
                ->whereBetween('date', array($from, $to))
                ->paginate(10);
        } else {
            $transactions = ReturnTransactionOverview::where('seller_id', $seller_id)
                ->where('transaction_type', $transaction_type)
                ->whereBetween('date', array($from, $to))
                ->paginate(10);
        }

        // dd($transactions);
        $years = Statement::groupBy('year')->get('year');
        $sellers = Seller::parentSeller()->get();

        return view('admin.list.transaction_overview', compact('transactions', 'years', 'sellers'));
    }

    public function fetchTtransactionOverview(Request $request)
    {
        // dd($request->month);
        $date = explode("-", $request->dateRange);

        $transaction_type = $request->transactionType;
        $seller_id = $request->sellerId;
        // $year = $request->year;
        // $month = $request->month;

        // $from = Carbon::create($year, $month)->firstOfMonth();
        // $to = Carbon::create($year, $month)->lastOfMonth();
        $from = date("Y-m-d", strtotime($date[0]));
        $to = date("Y-m-d", strtotime($date[1]));

        $enumoption = General::getEnumValues('tbl_transaction_overviews', 'transaction_type');
        if (array_key_exists($transaction_type, $enumoption)) {
            $transactions = TransactionOverview::where('seller_id', $seller_id)
                ->where('transaction_type', $transaction_type)
                ->whereBetween('date', array($from, $to))
                ->paginate(10);
        } else {
            $transactions = ReturnTransactionOverview::where('seller_id', $seller_id)
                ->where('transaction_type', $transaction_type)
                ->whereBetween('date', array($from, $to))
                ->paginate(10);
        }

        $years = Statement::groupBy('year')->get('year');
        $sellers = Seller::parentSeller()->get();

        return view('admin.list.ajaxlist.transaction_overview', compact('transactions', 'years', 'sellers'));
    }

    public function paySeller(Request $request, $id)
    {
        $payment_amount = $request->payment_amount;
        $closing_balance = Statement::find($id)->closing_balance;

        if ((!isset($payment_amount)) || ($payment_amount <= 0 || $payment_amount > $closing_balance)) {
            return back()->with('error', 'Invalid payment amount, amout exceed or is less than zero!');
        }

        $data = ([
            'payout' => $payment_amount,
            'closing_balance' => $closing_balance - $payment_amount
        ]);

        Statement::where('id', $id)->update($data);

        return back()->with('success', 'Payment Success!');
    }
}
