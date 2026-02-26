<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subsidiary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubsidiaryApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $subsidiaries = Subsidiary::with(['activities' => function ($q) {
                $q->select('id', 'subsidiaryId', 'activities');
            }])
            ->select(
                'id',
                'slug',
                'name',
                'shortName',
                'logo',
                'tagline',
                'slogan',
                'image',
                'icon',
                'overview',
                'vision',
                'mission'
            )
            ->orderBy('id', 'desc')
            ->get()
            ->map(fn ($s) => $this->transform($s))
            ->values();

        return response()->json([
            'data' => $subsidiaries,
        ]);
    }

    public function showById(Request $request, int $id): JsonResponse
    {
        $subsidiary = Subsidiary::with(['activities' => function ($q) {
                $q->select('id', 'subsidiaryId', 'activities');
            }])
            ->select(
                'id',
                'slug',
                'name',
                'shortName',
                'logo',
                'tagline',
                'slogan',
                'image',
                'icon',
                'overview',
                'vision',
                'mission'
            )
            ->where('id', $id)
            ->first();

        if (!$subsidiary) {
            return response()->json([
                'message' => 'Subsidiary not found',
            ], 404);
        }

        return response()->json([
            'data' => $this->transform($subsidiary),
        ]);
    }

    public function showBySlug(Request $request, string $slug): JsonResponse
    {
        $subsidiary = Subsidiary::with(['activities' => function ($q) {
                $q->select('id', 'subsidiaryId', 'activities');
            }])
            ->select(
                'id',
                'slug',
                'name',
                'shortName',
                'logo',
                'tagline',
                'slogan',
                'image',
                'icon',
                'overview',
                'vision',
                'mission'
            )
            ->where('slug', $slug)
            ->first();

        if (!$subsidiary) {
            return response()->json([
                'message' => 'Subsidiary not found',
            ], 404);
        }

        return response()->json([
            'data' => $this->transform($subsidiary),
        ]);
    }

    private function transform(Subsidiary $s): array
    {
        return [
            'id' => $s->id,
            'slug' => $s->slug,
            'name' => $s->name,
            'shortName' => $s->shortName,
            'logo' => $s->logo,
            'tagline' => $s->tagline,
            'slogan' => $s->slogan,
            'image' => $s->image,
            'icon' => $s->icon,
            'overview' => $s->overview,
            'vision' => $s->vision,
            'mission' => $s->mission,
            'activities' => $s->activities
                ? $s->activities->pluck('activities')->values()
                : [],
        ];
    }
}

