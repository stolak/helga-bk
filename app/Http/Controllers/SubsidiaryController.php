<?php

namespace App\Http\Controllers;

use App\Models\Subsidiary;
use App\Models\SubsidiaryActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubsidiaryController extends Controller
{
    public function setup(Request $request)
    {
        // Delete
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::transaction(function () use ($request) {
                SubsidiaryActivity::where('subsidiaryId', $request->input('id'))->delete();
                Subsidiary::where('id', $request->input('id'))->delete();
            });

            return back()->with('message', 'Subsidiary deleted successfully.');
        }

        // Create / Update (single submission includes activities[])
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $id = $request->input('id');

            $rules = [
                'slug' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'shortName' => 'nullable|string|max:255',
                'logo' => 'nullable|string|max:255',
                'tagline' => 'nullable|string|max:255',
                'slogan' => 'nullable|string|max:255',
                'image' => 'nullable|string|max:255',
                'icon' => 'nullable|string|max:255',
                'overview' => 'nullable|string',
                'vision' => 'nullable|string',
                'mission' => 'nullable|string',
                'activities' => 'nullable|array',
                'activities.*' => 'nullable|string|max:1000',
            ];

            if (isset($_POST['addnew'])) {
                $rules['slug'] .= '|unique:subsidiary,slug';
            } else {
                $rules['id'] = 'required|integer';
                $rules['slug'] .= '|unique:subsidiary,slug,' . $id . ',id';
            }

            $this->validate($request, $rules);

            $payload = $request->only([
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
                'mission',
            ]);

            $activities = collect($request->input('activities', []))
                ->map(fn ($v) => is_string($v) ? trim($v) : '')
                ->filter(fn ($v) => $v !== '')
                ->values();

            DB::transaction(function () use ($request, $payload, $activities, &$id) {
                if (isset($_POST['addnew'])) {
                    $subsidiary = Subsidiary::create($payload);
                    $id = $subsidiary->id;
                } else {
                    Subsidiary::where('id', $request->input('id'))->update($payload);
                }

                // Replace activities on every save (simple + predictable).
                SubsidiaryActivity::where('subsidiaryId', $id)->delete();
                foreach ($activities as $activityText) {
                    SubsidiaryActivity::create([
                        'subsidiaryId' => $id,
                        'activities' => $activityText,
                    ]);
                }
            });

            return redirect('subsidiary-setup?edit=' . $id)->with('message', 'Subsidiary saved successfully.');
        }

        // Page data
        $data['subsidiaries'] = Subsidiary::withCount('activities')
            ->orderBy('id', 'desc')
            ->get();

        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = Subsidiary::with('activities')
                ->where('id', $request->query('edit'))
                ->first();
        }

        return view('Setup.subsidiary', $data);
    }
}

