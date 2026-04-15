<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingBannerApiController extends Controller
{
    /**
     * Get all landing banners (no status filter).
     */
    public function index(Request $request): JsonResponse
    {
        $banners = DB::table('landing_banner')
            ->select('id', 'message', 'image', 'status', 'createdAt', 'updatedAt')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $banners,
        ]);
    }
}

