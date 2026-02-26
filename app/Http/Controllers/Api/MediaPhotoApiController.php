<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MediaPhoto;
use App\Models\MediaPhotoCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaPhotoApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $photos = MediaPhoto::query()
            ->select('id', 'media_categoryId', 'description', 'url', 'created_at', 'update_at')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $photos,
        ]);
    }

    public function showById(Request $request, int $id): JsonResponse
    {
        $photo = MediaPhoto::query()
            ->select('id', 'media_categoryId', 'description', 'url', 'created_at', 'update_at')
            ->where('id', $id)
            ->first();

        if (!$photo) {
            return response()->json([
                'message' => 'Photo not found',
            ], 404);
        }

        return response()->json([
            'data' => $photo,
        ]);
    }

    public function byCategory(Request $request, int $categoryId): JsonResponse
    {
        $photos = MediaPhoto::query()
            ->select('id', 'media_categoryId', 'description', 'url', 'created_at', 'update_at')
            ->where('media_categoryId', $categoryId)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $photos,
        ]);
    }

    /**
     * Get photos grouped by category.
     * Response shape (top-level array):
     * [
     *   { category: "...", categoryDescriptions: "...", photos: [ ... ] }
     * ]
     */
    public function groupedByCategory(Request $request): JsonResponse
    {
        $categories = MediaPhotoCategory::query()
            ->with(['photos' => function ($q) {
                $q->select('id', 'media_categoryId', 'description', 'url', 'created_at', 'update_at')
                    ->orderBy('id', 'desc');
            }])
            ->select('id', 'name', 'description')
            ->orderBy('id', 'desc')
            ->get()
            ->filter(fn ($c) => $c->photos && $c->photos->count() > 0)
            ->values()
            ->map(function ($c) {
                return [
                    'category' => $c->name,
                    'categoryDescriptions' => $c->description,
                    'photos' => $c->photos->values(),
                ];
            })
            ->values();

        // Return the raw array (not wrapped in {data: ...}) as requested.
        return response()->json($categories);
    }
}

