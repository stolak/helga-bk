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
            ->get();

        $serviceIds = $services->pluck('id')->filter()->values();

        $imagesByServiceId = [];
        if ($serviceIds->count() > 0) {
            $images = DB::table('service_images')
                ->select('id', 'serviceId', 'images', 'createdAt', 'updatedAt')
                ->whereIn('serviceId', $serviceIds->all())
                ->orderBy('id', 'asc')
                ->get();

            foreach ($images as $img) {
                $sid = (int) $img->serviceId;
                if (!isset($imagesByServiceId[$sid])) {
                    $imagesByServiceId[$sid] = [];
                }

                $imagesByServiceId[$sid][] = [
                    'id' => $img->id,
                    'url' => $img->images,
                    'createdAt' => $img->createdAt,
                    'updatedAt' => $img->updatedAt,
                ];
            }
        }

        $services = $services
            ->map(function ($row) use ($imagesByServiceId) {
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
                    'images' => $imagesByServiceId[(int) $row->id] ?? [],
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

