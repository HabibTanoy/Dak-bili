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
        // $images = $request->file('bill_images');
        // $image_name = '';
        // foreach($images as $image)
        // {
        //     $new_image = rand().'_'.$image->getClientOriginalExtension();
        //     $image->move(public_path('/uploads/images'), $new_image);
        //     $image_name = $image_name.$new_image.",";
        // }
        // $image_db = $image_name;
        // return response()->json($image_db);

        $bill_created = BillInfo::create([
            'phone_number' => $request->telephone_number,
            'bill_images' => $image_file_path,
            'agent_id' => $request->agent_id,
            'agent_name' => $request->agent_name,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'status' => 'assigned'
        ]);
        return response()->json([
            'id' => $bill_created->id,
            'message' => 'Assigned',
            'status' => 200
        ]);
    }

    public function billDelivered(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'bill_id' => 'required',
                'signature_images' => 'required',
                'agent_id' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $bill_id = $request->bill_id;
        $bills = BillInfo::find($bill_id);
        if ($bills->status != "assigned") {
           return response()->json([
                'message' => 'Already Delivered'
           ]);
        }

        $file_handler = new Images();
        $file_name = $request->telephone_number.'_'.rand(10000,99999);
        $image_file_path = $file_handler->uploadFile($request->file('signature_images'),$file_name);
        
        $bills->update([
            'agent_id' => $request->agent_id,
            'signature_images' => $image_file_path,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'status' => 'delivered'
        ]);
        return response()->json([
           'data' => $bills,
           'message' => 'Delivered Successfully',
           'status' => 200
        ]);
    }

    public function billNotDelivered(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'bill_id' => 'required',
            'comment' => 'required',
            'agent_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $bill_id = $request->bill_id;
        $bills = BillInfo::find($bill_id);
        if ($bills->status != "assigned") {
        return response()->json([
                'message' => 'Already Cancelled'
        ]);
        }
        $bills->update([
            'comment' => $request->comment,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'status' => 'cancelled'
        ]);
        return response()->json([
            'data' => $bills,
            'message' => 'Cancelled',
//            'status' => 200
        ]);
    }
}
