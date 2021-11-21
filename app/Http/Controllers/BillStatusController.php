<?php

namespace App\Http\Controllers;

use App\Models\BillInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillStatusController extends Controller
{
    public function billCreated(Request $request)
    {
        $this->validate($request, [
            'telephone_number' => 'required',
            'bill_images' => 'required',
            'agent_id' => 'required',
            'agent_name' => 'required'
        ]);

        if($request->hasfile('bill_images'))
        {

            foreach($request->file('bill_images') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);
                $data[] = $name;
            }
        }
        $bill_created = BillInfo::create([
            'phone_number' => $request->telephone_number,
            'bill_images'  => $data,
            'agent_id' => $request->agent_id,
            'agent_name' => $request->agent_name,
            'status' => 'Assigned'
        ]);
    }
}
