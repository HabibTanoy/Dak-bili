<?php

namespace App\Models;

use App\Services\S3ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOfficeImage extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function getFileAttribute($value)
    {
        $s3ImageService = app(S3ImageService::class); // Resolve the service using Laravel's service container
        return $s3ImageService->getImageFromS3("post_office/" . $value);
    }
}
