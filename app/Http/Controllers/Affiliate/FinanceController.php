<?php

namespace App\Http\Controllers\Affiliate;


use Carbon\Carbon;
use App\Models\AffiliateStatement;
use App\Models\AffiliateTransactionOverview;
use App\Models\AffiliateReturnTransactionOverview;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:affiliate');
    }

    public function affiliateTransactionOverview()
    {
        $transactions = new Collection();
        $years = AffiliateStatement::groupBy('year')->get('year');

        return view('affiliate.list.transaction_overview', compact('transactions', 'years'));
    }

    public function transactionOverview($year, $month)
    {
        $from = Carbon::create($year, $month)->firstOfMonth();
        $to = Carbon::create($year, $month)->lastOfMonth();

        $transactions = AffiliateTransactionOverview::where('affiliate_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->whereBetween('date', array($from, $to))
            ->paginate(10);
        // dd($enumoption);

        $years = AffiliateStatement::groupBy('year')->get('year');

        return view('affiliate.list.transaction_overview', compact('transactions', 'years'));
    }

    public function fetchTransactionOverview(Request $request)
    {
        $date = explode("-",$request->dateRange);

        $transaction_type = $request->transactionType;
        // $year = $request->year;
        // $month = $request->month;

        // $from = Carbon::create($year, $month)->firstOfMonth();
        // $to = Carbon::create($year, $month)->lastOfMonth();
        $from = date("Y-m-d", strtotime($date[0]));
        $to = date("Y-m-d", strtotime($date[1]));

        $transactions = AffiliateTransactionOverview::where('affiliate_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->whereBetween('date', array($from, $to))
            ->paginate(10);

        $years = AffiliateStatement::groupBy('year')->get('year');

        return view('affiliate.list.ajaxlist.transaction_overview', compact('transactions', 'years'));
    }
    ///

    public function refundTransactionOverview($year, $month)
    {
        $from = Carbon::create($year, $month)->firstOfMonth();
        $to = Carbon::create($year, $month)->lastOfMonth();

        $transactions = AffiliateReturnTransactionOverview::where('affiliate_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->whereBetween('date', array($from, $to))
            ->paginate(10);
        // dd($transactions);

        $years = AffiliateStatement::groupBy('year')->get('year');

        return view('affiliate.list.transaction_overview', compact('transactions', 'years'));
    }

    public function fetchrefundTransactionOverview(Request $request)
    {
        $date = explode("-",$request->dateRange);

        $transaction_type = $request->transactionType;
        // $year = $request->year;
        // $month = $request->month;

        // $from = Carbon::create($year, $month)->firstOfMonth();
        // $to = Carbon::create($year, $month)->lastOfMonth();
        $from = date("Y-m-d", strtotime($date[0]));
        $to = date("Y-m-d", strtotime($date[1]));

        $transactions = AffiliateReturnTransactionOverview::where('affiliate_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->whereBetween('date', array($from, $to))
            ->paginate(10);

        $years = AffiliateStatement::groupBy('year')->get('year');

        return view('affiliate.list.ajaxlist.transaction_overview', compact('transactions', 'years'));
    }
    ///

    public function financialOverview()
    {
        // dd(Auth::guard('affiliate')->user()->affiliate_code);
        $finance = AffiliateStatement::where('affiliate_id', Auth::guard('affiliate')->user()->affiliate_code)->latest('id')->first();
        // dd($finance);
        return view('affiliate.pages.finance', compact('finance'));
    }

    public function financialOverviewByMonth(Request $request)
    {
        $date = explode("-",$request->month);
        // dd($date);

        $year = $date[0];
        $month = $date[1];

        $forTheMonth = Carbon::create($year,$month)->format('F');
        // dd($year,$month);
        // $month = $request->month;
        // $year = date('Y');
        $finance = AffiliateStatement::where('affiliate_id', Auth::guard('affiliate')->user()->affiliate_code)->where('month', $month)->where('year', $year)->first();

        return view('affiliate.pages.finance', compact('finance','forTheMonth'));
    }
}
