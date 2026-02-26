<?php

namespace App\Http\Controllers;

use App\Models\MediaPhoto;
use App\Models\MediaPhotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaPhotoController extends Controller
{
    public function setup(Request $request)
    {
        // Delete category (+ photos)
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::transaction(function () use ($request) {
                MediaPhoto::where('media_categoryId', $request->input('id'))->delete();
                MediaPhotoCategory::where('id', $request->input('id'))->delete();
            });

            return back()->with('message', 'Photo category deleted successfully.');
        }

        // Create / Update category (single submission also replaces photos)
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $id = $request->input('id');

            $rules = [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:5000',
                'photo_description' => 'nullable|array',
                'photo_description.*' => 'nullable|string|max:2000',
                'photo_url' => 'nullable|array',
                'photo_url.*' => 'nullable|string|max:2000',
                'photo_file' => 'nullable|array',
                'photo_file.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ];

            if (isset($_POST['update'])) {
                $rules['id'] = 'required|integer';
            }

            $this->validate($request, $rules);

            $payload = $request->only(['name', 'description']);
            $descs = $request->input('photo_description', []);
            $urls = $request->input('photo_url', []);
            $files = $request->file('photo_file', []);

            $uploadDir = public_path('upload/media_photo');
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }

            DB::transaction(function () use ($request, $payload, $descs, $urls, $files, $uploadDir, &$id) {
                if (isset($_POST['addnew'])) {
                    $category = MediaPhotoCategory::create($payload);
                    $id = $category->id;
                } else {
                    $id = (int) $request->input('id');
                    MediaPhotoCategory::where('id', $id)->update($payload);
                }

                // Replace all photos on save (simple + predictable)
                MediaPhoto::where('media_categoryId', $id)->delete();

                $max = max(count($descs), count($urls), is_array($files) ? count($files) : 0);
                for ($i = 0; $i < $max; $i++) {
                    $desc = isset($descs[$i]) && is_string($descs[$i]) ? trim($descs[$i]) : null;
                    $url = isset($urls[$i]) && is_string($urls[$i]) ? trim($urls[$i]) : null;
                    $file = is_array($files) && array_key_exists($i, $files) ? $files[$i] : null;

                    // If a file is uploaded for this row, it overrides url.
                    if ($file) {
                        $ext = $file->getClientOriginalExtension();
                        $filename = time() . '_' . $i . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                        $file->move($uploadDir, $filename);
                        $url = '/upload/media_photo/' . $filename;
                    }

                    // Skip empty rows
                    if ((!$url || $url === '') && (!$desc || $desc === '')) {
                        continue;
                    }

                    MediaPhoto::create([
                        'media_categoryId' => $id,
                        'description' => $desc,
                        'url' => $url,
                    ]);
                }
            });

            return redirect('media-photo-setup?edit=' . $id)->with('message', 'Photo category saved successfully.');
        }

        // Page data
        $data['categories'] = MediaPhotoCategory::withCount('photos')
            ->orderBy('id', 'desc')
            ->get();

        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = MediaPhotoCategory::with('photos')
                ->where('id', $request->query('edit'))
                ->first();
        }

        return view('Setup.media_photo', $data);
    }
}

