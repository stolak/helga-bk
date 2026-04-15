<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingBannerController extends Controller
{
    public function setup(Request $request)
    {
        // Delete banner
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::table('landing_banner')->where('id', (int) $request->input('id'))->delete();

            return back()->with('message', 'Landing banner deleted successfully.');
        }

        // Create / Update banner
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $rules = [
                'message' => 'required|string|max:5000',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ];

            if (isset($_POST['update'])) {
                $rules['id'] = 'required|integer';
                $rules['status'] = 'required|in:Active,Inactive';
            }

            $this->validate($request, $rules);

            $id = isset($_POST['update']) ? (int) $request->input('id') : null;
            $existing = null;
            if ($id) {
                $existing = DB::table('landing_banner')->where('id', $id)->first();
            }

            $imageUrl = $existing->image ?? null;
            $file = $request->file('image');
            if ($file) {
                $uploadDir = public_path('upload/landing_banner');
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0755, true);
                }

                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $imageUrl = '/upload/landing_banner/' . $filename;
            }

            $payload = [
                'message' => $request->input('message'),
                'image' => $imageUrl,
                'updatedAt' => now()->toDateTimeString(),
            ];

            if (isset($_POST['addnew'])) {
                $payload['createdAt'] = now()->toDateTimeString();
                $payload['status'] = 'Active';
                $newId = DB::table('landing_banner')->insertGetId($payload);
                return redirect('landing-banner-setup?edit=' . $newId)->with('message', 'Landing banner created successfully.');
            }

            $payload['status'] = $request->input('status');
            DB::table('landing_banner')->where('id', $id)->update($payload);
            return redirect('landing-banner-setup?edit=' . $id)->with('message', 'Landing banner updated successfully.');
        }

        // Page data
        $data['banners'] = DB::table('landing_banner')->orderBy('id', 'desc')->get();

        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = DB::table('landing_banner')
                ->where('id', (int) $request->query('edit'))
                ->first();
        }

        return view('Setup.landing_banner', $data);
    }
}

