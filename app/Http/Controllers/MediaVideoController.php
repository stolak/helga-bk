<?php

namespace App\Http\Controllers;

use App\Models\MediaVideo;
use Illuminate\Http\Request;

class MediaVideoController extends Controller
{
    public function setup(Request $request)
    {
        // Delete
        if (isset($_POST['delete'])) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            MediaVideo::where('id', $request->input('id'))->delete();
            return back()->with('message', 'Video deleted successfully.');
        }

        // Create / Update
        if (isset($_POST['addnew']) || isset($_POST['update'])) {
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:5000',
                'url' => 'required|string|max:2000',
            ];
            if (isset($_POST['update'])) {
                $rules['id'] = 'required|integer';
            }
            $this->validate($request, $rules);

            $payload = $request->only(['title', 'description', 'url']);

            if (isset($_POST['addnew'])) {
                $video = MediaVideo::create($payload);
                return redirect('media-video-setup?edit=' . $video->id)
                    ->with('message', 'Video created successfully.');
            }

            MediaVideo::where('id', $request->input('id'))->update($payload);
            return redirect('media-video-setup?edit=' . $request->input('id'))
                ->with('message', 'Video updated successfully.');
        }

        // Page data
        $data['videos'] = MediaVideo::orderBy('id', 'desc')->get();
        $data['edit'] = null;
        if ($request->filled('edit')) {
            $data['edit'] = MediaVideo::where('id', $request->query('edit'))->first();
        }

        return view('Setup.media_video', $data);
    }
}

