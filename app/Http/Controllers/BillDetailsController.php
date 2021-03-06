<?php

namespace App\Http\Controllers;

use App\Models\BillInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillDetailsController extends Controller
{
    // filter order list by date
    public function billDateFilter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $current_date = Carbon::now()->format('Y-m-d');
        if (is_null($start_date))
            $start_date = $current_date;
        if (is_null($end_date))
            $end_date = $current_date;
        $search_by_filters = BillInfo::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->paginate(10);
//            ->get();
        $date_wise_delivered = BillInfo::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('status', '=', 'delivered')
            ->count();
        $date_wise_not_delivered =  BillInfo::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('status', '=', 'cancelled')
            ->count();
        return view('dateFilterSearch', compact('search_by_filters', 'date_wise_delivered', 'date_wise_not_delivered'));
    }
    // search by bill number
//    public function billSearchById(Request $request)
//    {
//        $bill_number = $request->id;
//        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
//            ->get();
//        return view('dashboard');
//    }
    // search by bill-types
    public function searchByBillTypes(Request $request)
    {
        $bill_types = $request->bill_types;
        $search_bill_types = BillInfo::where('bill_types', '=', $bill_types )
            ->get();
        return $search_bill_types;
    }
    // bill-types count
    public function billTypesCount(Request $request)
    {
        $bill_types = $request->bill_types;
        $bill_types_count = BillInfo::where('bill_types', '=', $bill_types )
            ->count();
        return $bill_types_count;
    }
}
