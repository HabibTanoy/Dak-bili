<?php
// app/Services/S3ImageService.php

namespace App\Services;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class S3ImageService
{
    // private $s3Client;

    // public function __construct(S3Client $s3Client)
    // {
    //     $this->s3Client = $s3Client;
    // }

    public function getImageFromS3($imageName)
    {
        try {
            // return $imageName;
            $alive_time = Carbon::now()->addMinutes(60)->toDateTimeString();
            $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
            $bucket = Config::get("filesystems.disks.s3.bucket");
            $command = $client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $imageName
            ]);
            $request = $client->createPresignedRequest($command, $alive_time);
            return (string)$request->getUri();
        } catch (S3Exception $e) {
            // Handle exceptions (e.g., image not found, access denied, etc.)
            // You can throw an exception or return a default image, etc.
            return null;
        }
    }
}
