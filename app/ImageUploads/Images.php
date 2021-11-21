<?php
namespace app\ImageUploads;
use Illuminate\Support\Facades\Storage;

class Images{
    protected $root;

    function __construct()
    {
        $this->root = 'storage';
    }
    public function uploadFile($file,$file_name): string
    {
        try{
            $file_name = $file_name.'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($file_name,$file->getContent());
            return $this->root.DIRECTORY_SEPARATOR.$file_name;
        }catch(\Exception $exception){
            dd($exception);
            throw new Exception($exception->getMessage());
        }
    }
}
