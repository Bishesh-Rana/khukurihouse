<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Affiliate;
use App\Models\AffiliateStatement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AffiliateTransactionOverview;
use App\Models\AffiliateReturnTransactionOverview;
use App\Http\Traits\AffiliateFinancialStatementTrait;
use Illuminate\Database\Eloquent\Collection;

class AdminAssociateFinanceController extends Controller
{
    use AffiliateFinancialStatementTrait;

    private $affiliate_transaction_overview, $commission_earned, $commission_refund ,$statement;

    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index()
    {
        $generate_statement = false;
        $previous_month = AffiliateStatement::latest('id')->first();
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


        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();
        $years = AffiliateStatement::groupBy('year')->get('year');
        // dd($years);
        $statements = new Collection;
        return view('admin.list.affiliate_finance_index_page', compact('generate_statement', 'affiliates', 'years', 'statements'));
    }

    public function adminGenerateAffiliateMonthlyStatement()
    {
        $reqest_month = date("m", strtotime("-1 months"));
        // $reqest_month = $current_month;
        // dd($reqest_month);

        $affiliates = Affiliate::where('publish_status','1')->where('delete_status','0')->get();
        // dd($affiliates);
        foreach ($affiliates as $affilate) {
            $this->commission_earned = 0;
            $this->commission_refund = 0;
            $this->affiliate_transaction_overview = new AffiliateTransactionOverview;
            $this->affiliate_transaction_return_overview = new AffiliateReturnTransactionOverview;
            $this->statement = new AffiliateStatement;

            $affiliate_transaction_overviews = $this->affiliate_transaction_overview->affiliateTransactionOverviews($affilate, $reqest_month);
            $affiliate_transaction_return_overviews = $this->affiliate_transaction_return_overview->affiliateTransactionReturnOverviews($affilate, $reqest_month);
            // dd($affiliate_transaction_return_overviews);
            // dd('yeta');
            foreach($affiliate_transaction_overviews as $row)
            {
                $this->commission_earned += $row->amount;
            }

            foreach($affiliate_transaction_return_overviews as $row)
            {
                $this->commission_refund += $row->amount;
            }

            $previous_month = AffiliateStatement::where('affiliate_id', $affilate->affiliate_code)->latest('id')->first();
            if (isset($previous_month)) {
                $this->statement->affiliate_id = $affilate->affiliate_code;
                $this->statement->month = $reqest_month;
                $this->statement->year = date('Y');
                $this->statement->opening_balance = $previous_month->closing_balance;

                $this->statement->commission_earned = $this->commission_earned;
                $this->statement->commission_refund = $this->commission_refund;

                $this->statement->payout = 0;

                $this->statement->closing_balance = $this->statement->opening_balance + $this->statement->commission_earned - $this->statement->commission_refund;
                // dd($this->statement->closing_balance);
                $finalStatement = $this->insertFinancialStatement($this->statement);
                // dd($finalStatement);
            }else{
                $this->statement->affiliate_id = $affilate->affiliate_code;
                $this->statement->month = $reqest_month;
                $this->statement->year = date('Y');
                $this->statement->opening_balance = 0;

                $this->statement->commission_earned = $this->commission_earned;
                $this->statement->commission_refund = $this->commission_refund;

                $this->statement->payout = 0;

                $this->statement->closing_balance = $this->statement->opening_balance + $this->statement->commission_earned - $this->statement->commission_refund;
                // dd($this->statement->closing_balance);
                $finalStatement = $this->insertFinancialStatement($this->statement);
                // dd($finalStatement);
            }

        }

        return back()->with('success', 'Affiliate Previous Month Statement Generated Successfully!');

    }

    public function affiliateMonthlyStatement(Request $request)
    {
        $date = explode("-", $request->month);

        $year = $date[0];
        $month = $date[1];

        $generate_statement = false;
        $previous_month = AffiliateStatement::latest('id')->first();
        if (isset($previous_month)) {
            if ($previous_month->month + 1 == date('m')) {
                $generate_statement = false;
            } else {
                $generate_statement = true;
            }
        } else {
            $generate_statement = true;
        }

        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();
        $years = AffiliateStatement::groupBy('year')->get('year');

        // $year = (int) $request->year;
        // $month = (int) $request->month;
        $affiliate_name = $request->affiliateName;

        $statements = AffiliateStatement::where('affiliate_id', $affiliate_name)->where('publish_status', '1')->where('delete_status', '0')
            ->when($year, function ($query, $year) {
                return $query->where("year", $year);
            })
            ->when($month, function ($query, $month) {
                return $query->where("month", $month);
            })
            ->get();

        // to be continue from ajax list after seller filter for the monthly statement
        return view('admin.list.ajaxlist.affiliate_finance_index_page', compact('statements'));
    }

    public function financialOverviewByMonth($id)
    {
        $finance = AffiliateStatement::find($id);
        // dd($finance);
        return view('admin.pages.affiliate_finance', compact('finance'));
    }

    public function affiliateTransactionOverview()
    {
        $transactions = new Collection();
        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();
        $years = AffiliateStatement::groupBy('year')->get('year');

        return view('admin.list.affiliate_transaction_overview', compact('transactions', 'years', 'affiliates'));
    }

    public function transactionOverview($year, $month, $affiliate_id)
    {
        $from = Carbon::create($year, $month)->firstOfMonth();
        $to = Carbon::create($year, $month)->lastOfMonth();

        $transactions = AffiliateTransactionOverview::where('affiliate_id', $affiliate_id)
            ->whereBetween('date', array($from, $to))
            ->paginate(10);

        // dd($transactions);
        $years = AffiliateStatement::groupBy('year')->get('year');
        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();

        return view('admin.list.affiliate_transaction_overview', compact('transactions', 'years', 'affiliates'));
    }

    public function fetchTransactionOverview(Request $request)
    {
        // dd($request->month);
        $date = explode("-", $request->dateRange);

        $affiliate_id = $request->affiliateId;
        // $year = $request->year;
        // $month = $request->month;

        // $from = Carbon::create($year, $month)->firstOfMonth();
        // $to = Carbon::create($year, $month)->lastOfMonth();
        $from = date("Y-m-d", strtotime($date[0]));
        $to = date("Y-m-d", strtotime($date[1]));

        $transactions = AffiliateTransactionOverview::where('affiliate_id', $affiliate_id)
                ->whereBetween('date', array($from, $to))
                ->paginate(10);

        $years = AffiliateStatement::groupBy('year')->get('year');
        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();

        return view('admin.list.ajaxlist.affiliate_transaction_overview', compact('transactions', 'years', 'sellers'));
    }

    ////
    public function returnTransactionOverview($year, $month, $affiliate_id)
    {
        $from = Carbon::create($year, $month)->firstOfMonth();
        $to = Carbon::create($year, $month)->lastOfMonth();

        $transactions = AffiliateReturnTransactionOverview::where('affiliate_id', $affiliate_id)
            ->whereBetween('date', array($from, $to))
            ->paginate(10);

        // dd($transactions);
        $years = AffiliateStatement::groupBy('year')->get('year');
        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();

        return view('admin.list.affiliate_transaction_overview', compact('transactions', 'years', 'affiliates'));
    }

    public function fetchReturnTransactionOverview(Request $request)
    {
        // dd($request->month);
        $date = explode("-", $request->dateRange);

        $affiliate_id = $request->affiliateId;
        // $year = $request->year;
        // $month = $request->month;

        // $from = Carbon::create($year, $month)->firstOfMonth();
        // $to = Carbon::create($year, $month)->lastOfMonth();
        $from = date("Y-m-d", strtotime($date[0]));
        $to = date("Y-m-d", strtotime($date[1]));

        $transactions = AffiliateReturnTransactionOverview::where('affiliate_id', $affiliate_id)
                ->whereBetween('date', array($from, $to))
                ->paginate(10);

        $years = AffiliateStatement::groupBy('year')->get('year');
        $affiliates = Affiliate::select('id', 'affiliate_code','first_name')->get();

        return view('admin.list.ajaxlist.affiliate_transaction_overview', compact('transactions', 'years', 'sellers'));
    }

    ////

    public function payAffiliate(Request $request, $id)
    {
        $payment_amount = $request->payment_amount;
        // dd($payment_amount);
        $closing_balance = AffiliateStatement::find($id)->closing_balance;

        if ((!isset($payment_amount)) || ($payment_amount <= 0 || $payment_amount > $closing_balance)) {
            return back()->with('error', 'Invalid payment amount, amout exceed or is less than zero!');
        }

        $data = ([
            'payout' => $payment_amount,
            'closing_balance' => $closing_balance - $payment_amount
        ]);

        AffiliateStatement::where('id', $id)->update($data);

        return back()->with('success', 'Payment Success!');
    }
}
