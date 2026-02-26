<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MediaVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaVideoApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $videos = MediaVideo::query()
            ->select('id', 'title', 'description', 'url')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $videos,
        ]);
    }

    public function showById(Request $request, int $id): JsonResponse
    {
        $video = MediaVideo::query()
            ->select('id', 'title', 'description', 'url')
            ->where('id', $id)
            ->first();

        if (!$video) {
            return response()->json([
                'message' => 'Video not found',
            ], 404);
        }

        return response()->json([
            'data' => $video,
        ]);
    }
}

