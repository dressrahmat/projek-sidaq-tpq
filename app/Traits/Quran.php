<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

trait Quran
{
    public function suratQuran()
    {
        $client = new Client();
        $url = 'https://equran.id/api/v2/surat';

        // Caching data for 1 hour
        return Cache::remember('surat', 60, function () use ($client, $url) {
            $response = $client->get($url);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                return $data;
            }
            return null;
        });
    }

    public function suratQuranDetail($nomor)
    {
        $client = new Client();
        $url = "https://equran.id/api/v2/surat/{$nomor}";

        return Cache::remember("surat_detail_{$nomor}", 60, function () use ($client, $url) {
            $response = $client->get($url);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                return $data;
            }
            return null;
        });
    }
}