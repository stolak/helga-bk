<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmenitiesController extends Controller
{
    public function setup(Request $request)
    {
        // Delete amenity
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::table('amenities')->where('id', (int) $request->input('id'))->delete();

            return back()->with('message', 'Amenity deleted successfully.');
        }

        // Create / Update amenity
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $rules = [
                'title' => 'required|string|max:255',
                'icon' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:5000',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ];

            if (isset($_POST['update'])) {
                $rules['id'] = 'required|integer';
            }

            $this->validate($request, $rules);

            $id = isset($_POST['update']) ? (int) $request->input('id') : null;
            $existing = null;
            if ($id) {
                $existing = DB::table('amenities')->where('id', $id)->first();
            }

            $imageUrl = $existing->image ?? null;
            $file = $request->file('image');
            if ($file) {
                $uploadDir = public_path('upload/amenities');
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0755, true);
                }

                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $imageUrl = '/upload/amenities/' . $filename;
            }

            $payload = [
                'icon' => $request->input('icon'),
                'title' => $request->input('title'),
                'image' => $imageUrl,
                'description' => $request->input('description'),
                'updatedAt' => now()->toDateTimeString(),
            ];

            if (isset($_POST['addnew'])) {
                $payload['createdAt'] = now()->toDateTimeString();
                $newId = DB::table('amenities')->insertGetId($payload);
                return redirect('amenities-setup?edit=' . $newId)->with('message', 'Amenity created successfully.');
            }

            DB::table('amenities')->where('id', $id)->update($payload);
            return redirect('amenities-setup?edit=' . $id)->with('message', 'Amenity updated successfully.');
        }

        // Page data
        $data['amenities'] = DB::table('amenities')->orderBy('id', 'desc')->get();

        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = DB::table('amenities')
                ->where('id', (int) $request->query('edit'))
                ->first();
        }

        return view('Setup.amenities', $data);
    }
}

