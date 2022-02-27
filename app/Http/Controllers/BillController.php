<?php

namespace App\Http\Controllers;

use App\Models\BillInfo;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function viewBillList(Request $request)
    {
        $bill_number = $request->id;
        $bill_lists = BillInfo::get();
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
            ->get();

        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered', 'bill_serach_by_id'));
    }
    public function registry(Request $request) {
        $bill_number = $request->id;
        $bill_lists = BillInfo::get();
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_types', '=', 'Registry' )
            ->get();
        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered', 'bill_serach_by_id'));
    }
    public function gep(Request $request) {
        $bill_number = $request->id;
        $bill_lists = BillInfo::get();
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_types', '=', 'GEP' )
            ->get();
        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered', 'bill_serach_by_id'));
    }
    public function parcel(Request $request) {
        $bill_number = $request->id;
        $bill_lists = BillInfo::get();
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_types', '=', 'Parcel' )
            ->get();
        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered', 'bill_serach_by_id'));
    }
    public function phoneBill(Request $request) {
        $bill_number = $request->id;
        $bill_lists = BillInfo::get();
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_types', '=', 'Telephone Bill' )
            ->get();
        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered', 'bill_serach_by_id'));
    }
    public function wasaBill(Request $request) {
        $bill_number = $request->id;
        $bill_lists = BillInfo::get();
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_number', '=', $bill_number )
            ->get();
        $bill_serach_by_id = BillInfo::where('bill_types', '=', 'Wasa Bill' )
            ->get();
        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered', 'bill_serach_by_id'));
    }
}
