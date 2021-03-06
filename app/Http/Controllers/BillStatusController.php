<?php

namespace App\Http\Controllers;

use App\ImageUploads\Images;
use App\Models\BillInfo;
use App\Models\IssueList;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillStatusController extends Controller
{
    // list of bill
    public function billList()
    {
        $bill_list = BillInfo::get();
        return response()->json([
            'data' => $bill_list,
            'status' => 200
        ]);
    }
    // list of bill API search by agent id
    // params: agent_id
    public function allBillListed(Request $request)
    {
        $all_bill_list = BillInfo::where('agent_id', $request->agent_id)
            ->get();

        return response()->json([
            'data' => $all_bill_list,
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
            'agent_name' => 'required',
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

        $bill_types = $request->bill_types;
        if ($bill_types == 1) {
            $types_name = "Registry";
            $bill_types_name = $types_name;
        } elseif ($bill_types == 2) {
            $types_name = "GEP";
            $bill_types_name = $types_name;
        } elseif ($bill_types == 3) {
            $types_name = "Parcel";
            $bill_types_name = $types_name;
        } elseif ($bill_types == 4) {
            $types_name = "Telephone Bill";
            $bill_types_name = $types_name;
        } elseif ($bill_types == 5) {
            $types_name = "Wasa Bill";
            $bill_types_name = $types_name;
        }

        $decode_for_bangla =  urldecode($request->issue_office);
        $bill_created = BillInfo::create([
            'bill_number' => $request->bill_number,
            'bill_types' => $bill_types_name,
            'bill_images' => $image_file_path,
            'agent_id' => $request->agent_id,
            'agent_name' => $request->agent_name,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'issue_office' => $decode_for_bangla,
            'status' => 'assigned'
        ]);

        // for autocomplete search data store
        // params: issue_office
        if ($bill_types == 4 or $bill_types == 5 and $decode_for_bangla == null)
        {
            return response()->json([
                'id' => $bill_created->id,
                'message' => 'Assigned',
                'status' => 200
            ]);
        }
        elseif (!IssueList::where('issue_office', $decode_for_bangla)
            ->exists())
        {
           IssueList::create([
                'issue_office' => $decode_for_bangla
            ]);
        }

        return response()->json([
            'id' => $bill_created->id,
            'message' => 'Assigned',
            'status' => 200
        ]);
    }
    // Delivered API
    // params: bill_id, signature_images, (lat, lon ->optional)
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
    // Cancel API
    // params: bill_id, comment, (lat, lon ->optional)
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
            'comment' => urldecode($request->comment),
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
    // For Autocomplete Search
    public function autocompleteSearch(Request $request)
    {
        $serach_result = $request->search_results;
        $filterResult = IssueList::where('issue_office', 'LIKE', '%'. $serach_result . '%')->get();

        return response()->json([
            'data' => $filterResult,
            'status' => 200
        ]);
    }
    // Bill Status Update
    // params: bill_id
    public function billStatusUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'bill_id' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $bill_id = $request->bill_id;
        $bills = BillInfo::find($bill_id);
       $bills->update([
           'signature_images' => '',
           'comment' => '',
           'status' => $request->bill_status
       ]);
        return response()->json([
            'data' => $bills,
        ]);
    }
}
