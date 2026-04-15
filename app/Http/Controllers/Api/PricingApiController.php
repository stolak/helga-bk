<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricingApiController extends Controller
{
    /**
     * Join pricing_category -> pricing on pricing.categoryId = pricing_category.id
     * and return a nested structure grouped by cardPosition.
     */
    public function groupedByCard(Request $request): JsonResponse
    {
        $rows = DB::table('pricing_category as pc')
            ->leftJoin('pricing as p', 'p.categoryId', '=', 'pc.id')
            ->select(
                'pc.id as pricingCategoryId',
                'pc.cardPosition',
                'pc.category as categoryName',
                'p.id as pricingId',
                'p.description',
                'p.amount',
                'p.status as pricingStatus'
            )
            ->where(function ($q) {
                $q->whereNull('p.id')
                    ->orWhere('p.status', 'Active');
            })
            ->orderBy('pc.cardPosition', 'asc')
            ->orderBy('pc.id', 'asc')
            ->orderBy('p.id', 'asc')
            ->get();

        $byCard = [];

        foreach ($rows as $row) {
            $cardKey = (string) $row->cardPosition;
            if (!isset($byCard[$cardKey])) {
                $byCard[$cardKey] = [
                    'cardPosition' => $row->cardPosition,
                    'categoryPricing' => [],
                ];
            }

            $catKey = (string) $row->pricingCategoryId;
            if (!isset($byCard[$cardKey]['categoryPricing'][$catKey])) {
                $byCard[$cardKey]['categoryPricing'][$catKey] = [
                    'category' => (string) ($row->categoryName ?? ''),
                    'pricing' => [],
                ];
            }

            if ($row->pricingId) {
                $byCard[$cardKey]['categoryPricing'][$catKey]['pricing'][] = [
                    'description' => $row->description,
                    'amount' => $row->amount !== null ? (float) $row->amount : null,
                ];
            }
        }

        $out = [];
        foreach ($byCard as $card) {
            $card['categoryPricing'] = array_values($card['categoryPricing']);
            $out[] = $card;
        }

        return response()->json($out);
    }
}
