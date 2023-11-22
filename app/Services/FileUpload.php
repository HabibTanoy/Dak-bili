<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class FileUpload{
    protected $file;
    protected $folder;

    public function setFile($file){
        $this->file=$file;
        return $this;
    }

    public function setFolder($folder){
        $this->folder=$folder;
        return $this;
    }

    public function upload(){
        $four_digit_random_number = random_int(1000, 9999);
        $name=Carbon::now()->timestamp.$four_digit_random_number.'.png';
        $filename = $this->folder.'/'.$name;
        FacadesStorage::disk('s3')->put($filename, file_get_contents($this->file));
        return $name;
    }
}