<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricingController extends Controller
{
    public function setup(Request $request)
    {
        // Delete pricing item
        if (isset($_POST['delete_pricing'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::table('pricing')->where('id', (int) $request->input('id'))->delete();

            return back()->with('message', 'Pricing deleted successfully.');
        }

        // Create / Update pricing item
        if (isset($_POST['addnew_pricing']) || isset($_POST['update_pricing'])) {
            $rules = [
                'categoryId' => 'required|integer',
                'description' => 'nullable|string|max:5000',
                'amount' => 'required|numeric',
                'status' => 'required|in:Active,Inactive',
            ];
            if (isset($_POST['update_pricing'])) {
                $rules['id'] = 'required|integer';
            }

            $this->validate($request, $rules);

            $payload = [
                'categoryId' => (int) $request->input('categoryId'),
                'description' => $request->input('description'),
                'amount' => $request->input('amount'),
                'status' => $request->input('status'),
                'updatedAt' => now()->toDateTimeString(),
            ];

            if (isset($_POST['addnew_pricing'])) {
                $payload['createdAt'] = now()->toDateTimeString();
                $newId = DB::table('pricing')->insertGetId($payload);
                return redirect('pricing-setup?edit_pricing=' . $newId)->with('message', 'Pricing created successfully.');
            }

            $id = (int) $request->input('id');
            DB::table('pricing')->where('id', $id)->update($payload);
            return redirect('pricing-setup?edit_pricing=' . $id)->with('message', 'Pricing updated successfully.');
        }

        // Delete card assignment
        if (isset($_POST['delete_card'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::table('pricing_category')->where('id', (int) $request->input('id'))->delete();

            return back()->with('message', 'Card assignment deleted successfully.');
        }

        // Create / Update card assignment
        if (isset($_POST['addnew_card']) || isset($_POST['update_card'])) {
            $rules = [
                'cardPosition' => 'required|in:Card1,Card2,Card3,Card4',
                'category' => 'required|string|max:255',
            ];
            if (isset($_POST['update_card'])) {
                $rules['id'] = 'required|integer';
            }

            $this->validate($request, $rules);

            $payload = [
                'cardPosition' => $request->input('cardPosition'),
                'category' => $request->input('category'),
                'updatedAt' => now()->toDateTimeString(),
            ];

            if (isset($_POST['addnew_card'])) {
                $payload['createdAt'] = now()->toDateTimeString();
                $newId = DB::table('pricing_category')->insertGetId($payload);
                return redirect('pricing-setup?edit_card=' . $newId)->with('message', 'Card assignment created successfully.');
            }

            $id = (int) $request->input('id');
            DB::table('pricing_category')->where('id', $id)->update($payload);
            return redirect('pricing-setup?edit_card=' . $id)->with('message', 'Card assignment updated successfully.');
        }

        // Page data
        $data['pricing'] = DB::table('pricing as p')
            ->leftJoin('pricing_category as pc', 'pc.id', '=', 'p.categoryId')
            ->select('p.*', 'pc.category as categoryName')
            ->orderBy('p.id', 'desc')
            ->get();

        $data['categoryOptions'] = DB::table('pricing_category')
            ->select('id', 'category')
            ->orderBy('id', 'desc')
            ->get();

        $data['cards'] = DB::table('pricing_category as pc')
            ->leftJoin('pricing as p', 'p.categoryId', '=', 'pc.id')
            ->select(
                'pc.id',
                'pc.cardPosition',
                'pc.category',
                'pc.createdAt',
                'pc.updatedAt',
                DB::raw('COUNT(p.id) as pricingCount')
            )
            ->groupBy('pc.id', 'pc.cardPosition', 'pc.category', 'pc.createdAt', 'pc.updatedAt')
            ->orderBy('pc.id', 'desc')
            ->get()
            ->map(function ($row) {
                $cat = isset($row->category) ? (string) $row->category : '';
                $isNumericId = $cat !== '' && ctype_digit($cat);

                $row->categoryId = $isNumericId ? (int) $cat : null;
                $row->categoryName = $isNumericId ? null : ($cat !== '' ? $cat : null);

                return $row;
            });

        $data['editPricing'] = null;
        if ($request->filled('edit_pricing')) {
            $data['editPricing'] = DB::table('pricing')
                ->where('id', (int) $request->query('edit_pricing'))
                ->first();
        }

        $data['editCard'] = null;
        if ($request->filled('edit_card')) {
            $data['editCard'] = DB::table('pricing_category')
                ->where('id', (int) $request->query('edit_card'))
                ->first();
        }

        return view('Setup.pricing', $data);
    }
}

