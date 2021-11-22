<?php

namespace App\Http\Controllers;

use App\ImageUploads\Images;
use App\Models\BillInfo;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillStatusController extends Controller
{
    // list of bill API
    public function allBillListed()
    {
        $all_bill_list = BillInfo::get();
        return response()->json([
            'data' => $all_bill_list,
            'status' => 200
         ]);
    }
    // created bill info API
    public function billCreated(Request $request)
    {
        $this->validate($request, [
            'telephone_number' => 'required',
            'bill_images' => 'required',
            'agent_id' => 'required',
            'agent_name' => 'required'
        ]);
        $file_handler = new Images();
        $file_name = $request->telephone_number.'_'.rand(10000,99999);
        $image_file_path = $file_handler->uploadFile($request->file('bill_images'),$file_name);


        $bill_created = BillInfo::create([
            'phone_number' => $request->telephone_number,
            'bill_images' => $image_file_path,
            'agent_id' => $request->agent_id,
            'agent_name' => $request->agent_name,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'status' => 'Assigned'
        ]);
        return response()->json([
            'message' => 'Assigned',
            'status' => 200
        ]);
    }

    // public function billDelivered(Request $request)
    // {
        
    // }
}
