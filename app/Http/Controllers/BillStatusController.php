<?php

namespace App\Http\Controllers;

use App\ImageUploads\Images;
use App\Models\BillInfo;
use App\Models\BillTypes;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillStatusController extends Controller
{
    // list of bill API
    public function allBillListed(Request $request)
    {
        $all_bill_list = BillInfo::where('bill_types', $request->bill_types)
            ->where('agent_id', $request->agent_id)
            ->get();
//        dd($all_bill_list->bill_types);
        foreach ($all_bill_list as $type) {
//            dd($type->bill_types);
            if ($type->bill_types == 1) {
                $types_name = "Registry";
            } elseif ($type->bill_types == 2) {
                $types_name = "GEP";
            } elseif ($type->bill_types == 3) {
                $types_name = "Parcel";
            } elseif ($type->bill_typese == 4) {
                $types_name = "Telephone Bill";
            } elseif ($type->bill_types == 5) {
                $types_name = "Wasa Bill";
            }
        }
        return response()->json([
            'data' => $all_bill_list,
            'bill types' => $types_name,
            'status' => 200
         ]);
    }
    // created bill info API
    public function billCreated(Request $request)
    {
        $this->validate($request, [
            'bill_number' => 'required',
            'bill_types' => 'required',
            'bill_images' => 'required',
            'agent_id' => 'required',
            'agent_name' => 'required'
        ]);
        $file_handler = new Images();
        $file_name = $request->bill_number.'_'.rand(10000,99999);
        $image_file_path = $file_handler->uploadFile($request->file('bill_images'),$file_name);
        // $image_db = [];
        // $images = $request->file('bill_images');
        // $image_name = '';
        // foreach($images as $image)
        // {
        //     $new_image = rand().'_'.$image->getClientOriginalExtension();
        //     $image->move(public_path('/uploads/images'), $new_image);
        //     $image_name = $image_name.$new_image.",";
        // }
        // $image_db = $image_name;
        // dd($image_db);
        // return response()->json($image_db);

        $bill_created = BillInfo::create([
            'bill_number' => $request->bill_number,
            'bill_types' => $request->bill_types,
            'bill_images' => $image_file_path,
            'agent_id' => $request->agent_id,
            'agent_name' => $request->agent_name,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'status' => 'assigned'
        ]);
//        $bill_types = BillTypes::create([
//           'bill_id' => $bill_created->id,
//            'bill_types' => $request->bill_types
//        ]);
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
        $file_name = $request->bill_number.'_'.rand(10000,99999);
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
