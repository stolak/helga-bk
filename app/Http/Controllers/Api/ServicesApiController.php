<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $services = DB::table('services')
            ->select('id', 'icon', 'title', 'image', 'tags', 'createdAt', 'updatedAt', 'description')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($row) {
                $tags = null;
                if (isset($row->tags) && $row->tags !== null && $row->tags !== '') {
                    $decoded = json_decode($row->tags, true);
                    $tags = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : null;
                }

                return [
                    'id' => $row->id,
                    'icon' => $row->icon,
                    'title' => $row->title,
                    'image' => $row->image,
                    'tags' => $tags,
                    'createdAt' => $row->createdAt,
                    'updatedAt' => $row->updatedAt,
                    'description' => $row->description,
                ];
            })
            ->values();

        return response()->json([
            'data' => $services,
        ]);
    }
}

