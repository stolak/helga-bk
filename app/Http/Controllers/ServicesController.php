<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function setup(Request $request)
    {
        // Add multiple images to a service
        if (isset($_POST['add_service_images'])) {
            $this->validate($request, [
                'serviceId' => 'required|integer',
                'images' => 'required',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ]);

            $serviceId = (int) $request->input('serviceId');
            $service = DB::table('services')->where('id', $serviceId)->first();
            if (!$service) {
                return back()->with('error', 'Service not found.');
            }

            $files = $request->file('images', []);
            if (!is_array($files)) {
                $files = [$files];
            }

            $uploadDir = public_path('upload/services/images');
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }

            $now = now()->toDateTimeString();
            $rows = [];

            foreach ($files as $file) {
                if (!$file) {
                    continue;
                }

                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $imageUrl = '/upload/services/images/' . $filename;

                $rows[] = [
                    'serviceId' => $serviceId,
                    'images' => $imageUrl,
                    'createdAt' => $now,
                    'updatedAt' => $now,
                ];
            }

            if (count($rows) === 0) {
                return back()->with('error', 'No images were uploaded.');
            }

            DB::table('service_images')->insert($rows);

            return redirect('services-setup?edit=' . $serviceId)->with('message', 'Service images uploaded successfully.');
        }

        // Delete a single service image
        if (isset($_POST['delete_service_image'])) {
            $this->validate($request, [
                'id' => 'required|integer',
                'serviceId' => 'required|integer',
            ]);

            $imageId = (int) $request->input('id');
            $serviceId = (int) $request->input('serviceId');

            DB::table('service_images')
                ->where('id', $imageId)
                ->where('serviceId', $serviceId)
                ->delete();

            return redirect('services-setup?edit=' . $serviceId)->with('message', 'Service image deleted successfully.');
        }

        // Delete service
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            DB::table('services')->where('id', (int) $request->input('id'))->delete();
            DB::table('service_images')->where('serviceId', (int) $request->input('id'))->delete();

            return back()->with('message', 'Service deleted successfully.');
        }

        // Create / Update service
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $rules = [
                'title' => 'required|string|max:255',
                'icon' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:5000',
                'tags' => 'nullable',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ];

            if (isset($_POST['update'])) {
                $rules['id'] = 'required|integer';
            }

            $this->validate($request, $rules);

            $id = isset($_POST['update']) ? (int) $request->input('id') : null;
            $existing = null;
            if ($id) {
                $existing = DB::table('services')->where('id', $id)->first();
            }

            $tags = $this->normalizeTags($request->input('tags', null));

            $imageUrl = $existing->image ?? null;
            $file = $request->file('image');
            if ($file) {
                $uploadDir = public_path('upload/services');
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0755, true);
                }

                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $imageUrl = '/upload/services/' . $filename;
            }

            $payload = [
                'icon' => $request->input('icon'),
                'title' => $request->input('title'),
                'image' => $imageUrl,
                'tags' => $tags,
                'description' => $request->input('description'),
                'updatedAt' => now()->toDateTimeString(),
            ];

            if (isset($_POST['addnew'])) {
                $payload['createdAt'] = now()->toDateTimeString();
                $newId = DB::table('services')->insertGetId($payload);
                return redirect('services-setup?edit=' . $newId)->with('message', 'Service created successfully.');
            }

            DB::table('services')->where('id', $id)->update($payload);
            return redirect('services-setup?edit=' . $id)->with('message', 'Service updated successfully.');
        }

        // Page data
        $data['services'] = DB::table('services')->orderBy('id', 'desc')->get();

        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = DB::table('services')
                ->where('id', (int) $request->query('edit'))
                ->first();
        }

        $data['editImages'] = collect();
        if ($data['edit']) {
            $data['editImages'] = DB::table('service_images')
                ->where('serviceId', (int) $data['edit']->id)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('Setup.services', $data);
    }

    private function normalizeTags($input): ?string
    {
        if ($input === null) {
            return null;
        }

        if (is_string($input)) {
            $trimmed = trim($input);
            if ($trimmed === '') {
                return null;
            }

            $decoded = json_decode($trimmed, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                if (is_array($decoded)) {
                    $arr = array_values(array_filter(array_map(function ($v) {
                        return is_string($v) ? trim($v) : null;
                    }, $decoded), function ($v) {
                        return is_string($v) && $v !== '';
                    }));
                    return count($arr) > 0 ? json_encode($arr) : null;
                }
                return null;
            }

            $parts = preg_split('/\s*,\s*/', $trimmed);
            $parts = array_values(array_filter(array_map(function ($v) {
                return trim((string) $v);
            }, $parts), function ($v) {
                return $v !== '';
            }));
            return count($parts) > 0 ? json_encode($parts) : null;
        }

        if (is_array($input)) {
            $arr = array_values(array_filter(array_map(function ($v) {
                return is_string($v) ? trim($v) : null;
            }, $input), function ($v) {
                return is_string($v) && $v !== '';
            }));
            return count($arr) > 0 ? json_encode($arr) : null;
        }

        return null;
    }
}

