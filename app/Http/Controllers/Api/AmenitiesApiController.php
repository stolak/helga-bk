<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmenitiesApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $amenities = DB::table('amenities')
            ->select('id', 'icon', 'title', 'image', 'createdAt', 'updatedAt', 'description')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'data' => $amenities,
        ]);
    }
}

