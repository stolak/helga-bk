<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageBannerApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $banners = DB::table('page_banner')
            ->select('id', 'eyebrow', 'title', 'subtitle', 'image', 'textColor', 'status', 'createdAt', 'updatedAt')
            ->where('status', 'Active')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $banners,
        ]);
    }

    public function showById(Request $request, int $id): JsonResponse
    {
        $banner = DB::table('page_banner')
            ->select('id', 'eyebrow', 'title', 'subtitle', 'image', 'textColor', 'status', 'createdAt', 'updatedAt')
            ->where('id', $id)
            ->first();

        if (!$banner) {
            return response()->json([
                'message' => 'Banner not found',
            ], 404);
        }

        return response()->json([
            'data' => $banner,
        ]);
    }
}

