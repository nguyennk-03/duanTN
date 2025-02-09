<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function saveApiToJson()
    {
        $response = Http::get('http://127.0.0.1:8000/api/sanpham');
        $data = $response->json();

        Storage::disk('public')->put('api_data.json', json_encode($data, JSON_PRETTY_PRINT));

        return response()->json(['message' => 'API data saved successfully!']);
    }
}
