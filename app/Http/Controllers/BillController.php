<?php

namespace App\Http\Controllers;

use App\Models\BillInfo;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function viewBillList()
    {
        $bill_lists = BillInfo::get();
//        dd($bill_lists);
        $total_delivered = BillInfo::where('status', '=', 'delivered')
            ->get();
        $total_not_delivered =  BillInfo::where('status', '=', 'cancelled')
            ->get();
        return view('dashboard', compact('bill_lists', 'total_delivered', 'total_not_delivered'));
    }

    public function viewGep()
    {
        $all_gep = BillInfo::where('bill_types', 'GEP')
            ->get();
        dd($all_gep);
    }
}
