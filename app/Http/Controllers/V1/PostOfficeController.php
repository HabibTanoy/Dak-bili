<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavePostOfficeRequest;
use App\Models\PostOffice;
use App\Models\PostOfficeImage;
use App\Services\FileUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getPostOffice(){
        $postoffice=PostOffice::with('image')->orderBy('id','desc')->get();
        // foreach($postoffice as $po){
        //     foreach($po->image as $image){
        //         $image->image=$this->getImageS3("post_office/".$image->file);
        //         // dd($image);
        //     }
        // }
        return $this->setStatusCode(200)
                    ->setMessage('Post Office Fetch Successfully')
                    ->responseWithCollection($postoffice);
    }

    public function savePostOffice(SavePostOfficeRequest $request){
        DB::beginTransaction();
        try {
            $user=JWTAuth::user();
            $post_office=new PostOffice();
            $post_office->name=$request->name;
            $post_office->code=$request->code;
            $post_office->village=$request->village;
            $post_office->ptype=$request->ptype;
            $post_office->subtype=$request->subtype;
            $post_office->latitude=$request->latitude;
            $post_office->longitude=$request->longitude;
            $post_office->created_by=$user->id;
            $post_office->save();
            if(isset($request->images) && count($request->images)>0){
                foreach($request->images as $image){
                    $url=(new FileUpload)->setFile($image["file"])->setFolder('post_office')->upload();
                    $post_office_image=new PostOfficeImage();
                    $post_office_image->file=$url;
                    $post_office_image->distance=$image['distance'];
                    $post_office_image->post_office_id=$post_office->id;
                    $post_office_image->save();
                }
            }
            DB::commit();
            return $this->setStatusCode(200)
                        ->setMessage("Post Office Save Successfully")
                        ->responseWithSuccess();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->setStatusCode(500)
                        ->setMessage($e->getMessage())
                        ->responseWithError();
        }
    }
    public function shortImage($data){
        if(isset($data['signboard_image'])){
            $res[]=[
                'image'=>(new FileUpload)->setFile($data['signboard_image'])->setFolder('outlet')->upload(),
                'type'=>'signboard'
            ];
        }
        return $res;
    }
    public function getImageS3($file){
        $alive_time = Carbon::now()->addMinutes(60)->toDateTimeString();
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $bucket = Config::get("filesystems.disks.s3.bucket");
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $file
        ]);
        $request = $client->createPresignedRequest($command, $alive_time);
        return (string)$request->getUri();
    }

}
