<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageBannerController extends Controller
{
    public function setup(Request $request)
    {
        // Delete banner
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::table('page_banner')->where('id', (int) $request->input('id'))->delete();

            return back()->with('message', 'Banner deleted successfully.');
        }

        // Create / Update banner
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $rules = [
                'eyebrow' => 'nullable|string|max:255',
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'textColor' => 'nullable|string|max:50',
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
                $existing = DB::table('page_banner')->where('id', $id)->first();
            }

            $imageUrl = $existing->image ?? null;
            $file = $request->file('image');
            if ($file) {
                $uploadDir = public_path('upload/page_banner');
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0755, true);
                }

                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $imageUrl = '/upload/page_banner/' . $filename;
            }

            $payload = [
                'eyebrow' => $request->input('eyebrow'),
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'image' => $imageUrl,
                'textColor' => $request->input('textColor'),
                'updatedAt' => now()->toDateTimeString(),
            ];

            if (isset($_POST['addnew'])) {
                $payload['createdAt'] = now()->toDateTimeString();
                $payload['status'] = 'Active';
                $newId = DB::table('page_banner')->insertGetId($payload);
                return redirect('page-banner-setup?edit=' . $newId)->with('message', 'Banner created successfully.');
            }

            $payload['status'] = $request->input('status');
            DB::table('page_banner')->where('id', $id)->update($payload);
            return redirect('page-banner-setup?edit=' . $id)->with('message', 'Banner updated successfully.');
        }

        // Page data
        $data['banners'] = DB::table('page_banner')->orderBy('id', 'desc')->get();

        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = DB::table('page_banner')
                ->where('id', (int) $request->query('edit'))
                ->first();
        }

        return view('Setup.page_banner', $data);
    }
}

