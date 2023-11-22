<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReverseGeo
{
    public $latitude,$longitude;
    public function setLatitude($q)
    {
        $this->latitude = $q;
        return $this;
    }
    public function setLongitude($p)
    {
        $this->longitude = $p;
        return $this;
    }

    public function get()
    {
        $apiKey = env('BARIKOI_API_KEY');
        $response = Http::get('https://barikoi.xyz/v1/api/search/reverse/'.$apiKey.'/geocode?longitude='.$this->longitude.'&latitude='.$this->latitude.'&address=true&district=true&sub_district=true&division=true');
        $response = json_decode($response->body(),true);
        return $response;
    }

    private function prepareResponse($response)
    {
        return [
            'given_address'     => $response['given_address'] ?? null,
            'exact_address'     => $response['geocoded_address']['Address'] ?? null,
            'area'              => $response['geocoded_address']['area'] ?? null,
            'latitude'          => $response['geocoded_address']['latitude'] ?? null,
            'longitude'         => $response['geocoded_address']['longitude'] ?? null,
            'city'              => $response['geocoded_address']['city'] ?? null,
            'score'             => $response['confidence_score_percentage'] ?? null,
            'is_exact_address'  => !empty($response['confidence_score_percentage']) && $response['confidence_score_percentage'] > 90 ? 1 : 0
        ];
    }
}
