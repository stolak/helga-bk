<!-- Page Wrapper -->
@extends('layouts.layout')
@section('pageTitle')
    {{ env('Page_Title') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Media Photo Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Media Photo Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('media-photo-setup') }}" class="btn btn-sm btn-secondary">New</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- include notoifcation -->
            @include('_partialView.nofication')
            <!-- /include notoifcation -->

            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                {{ $edit ? 'Edit Photo Category' : 'Create Photo Category' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" name="mediaForm" id="mediaForm">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">

                                <div class="form-group">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $edit->name ?? '') }}" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Category Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $edit->description ?? '') }}</textarea>
                                </div>

                                <hr>

                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="mb-0">Photos (URL or Upload)</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="addPhotoBtn">
                                        Add photo
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    For each row, you can provide a URL OR browse to upload a file (upload overrides URL).
                                </small>

                                <div id="photosWrap" class="mt-3">
                                    @php
                                        $rows = [];
                                        if (is_array(old('photo_url')) || is_array(old('photo_description'))) {
                                            $oldUrls = old('photo_url', []);
                                            $oldDescs = old('photo_description', []);
                                            $max = max(count($oldUrls), count($oldDescs));
                                            for ($i = 0; $i < $max; $i++) {
                                                $rows[] = [
                                                    'url' => $oldUrls[$i] ?? '',
                                                    'description' => $oldDescs[$i] ?? '',
                                                ];
                                            }
                                        } elseif ($edit && $edit->photos) {
                                            foreach ($edit->photos as $p) {
                                                $rows[] = [
                                                    'url' => $p->url,
                                                    'description' => $p->description,
                                                ];
                                            }
                                        }
                                        if (count($rows) === 0) {
                                            $rows[] = ['url' => '', 'description' => ''];
                                        }
                                    @endphp

                                    @foreach ($rows as $r)
                                        <div class="border rounded p-2 mb-2 photo-row">
                                            <div class="form-group mb-2">
                                                <label class="mb-1">Photo Description</label>
                                                <input type="text" class="form-control" name="photo_description[]"
                                                    value="{{ $r['description'] ?? '' }}" autocomplete="off">
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="mb-1">Photo URL (optional)</label>
                                                <input type="text" class="form-control" name="photo_url[]"
                                                    value="{{ $r['url'] ?? '' }}" placeholder="/upload/... or https://..."
                                                    autocomplete="off">
                                            </div>

                                            <div class="form-group mb-0">
                                                <label class="mb-1">Or Upload (optional)</label>
                                                <div class="d-flex">
                                                    <input type="file" class="form-control" name="photo_file[]"
                                                        accept=".jpg,.jpeg,.png,.gif,.svg,.webp">
                                                    <button type="button" class="btn btn-outline-danger ml-2 remove-photo">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="text-right mt-3">
                                    @if ($edit)
                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                    @else
                                        <button type="submit" class="btn btn-primary" name="addnew">Save</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Photo Categories</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Photos</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $c)
                                            <tr>
                                                <td>{{ $c->id }}</td>
                                                <td>{{ $c->name }}</td>
                                                <td>{{ $c->photos_count }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('media-photo-setup?edit=' . $c->id) }}">
                                                        Edit
                                                    </a>

                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this category? This will also remove all photos under it.')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $c->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No categories yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if ($edit)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Preview ({{ $edit->name }})</h5>
                            </div>
                            <div class="card-body">
                                @if ($edit->photos && $edit->photos->count() > 0)
                                    <div class="row">
                                        @foreach ($edit->photos as $p)
                                            <div class="col-md-4 mb-3">
                                                <div class="border rounded p-2 h-100">
                                                    <div class="text-muted small mb-2">{{ $p->description }}</div>
                                                    @if ($p->url)
                                                        <img src="{{ $p->url }}" alt="photo" class="img-fluid"
                                                            style="max-height: 140px; object-fit: cover; width: 100%;">
                                                        <div class="small mt-2 text-truncate">
                                                            <a href="{{ $p->url }}" target="_blank">{{ $p->url }}</a>
                                                        </div>
                                                    @else
                                                        <div class="text-muted">No URL</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted mb-0">No photos.</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    <script>
        (function() {
            function rowHtml() {
                return `
                <div class="border rounded p-2 mb-2 photo-row">
                    <div class="form-group mb-2">
                        <label class="mb-1">Photo Description</label>
                        <input type="text" class="form-control" name="photo_description[]" value="" autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-1">Photo URL (optional)</label>
                        <input type="text" class="form-control" name="photo_url[]" value="" placeholder="/upload/... or https://..." autocomplete="off">
                    </div>
                    <div class="form-group mb-0">
                        <label class="mb-1">Or Upload (optional)</label>
                        <div class="d-flex">
                            <input type="file" class="form-control" name="photo_file[]" accept=".jpg,.jpeg,.png,.gif,.svg,.webp">
                            <button type="button" class="btn btn-outline-danger ml-2 remove-photo">Remove</button>
                        </div>
                    </div>
                </div>`;
            }

            $('#addPhotoBtn').on('click', function() {
                $('#photosWrap').append(rowHtml());
            });

            $(document).on('click', '.remove-photo', function() {
                var $rows = $('#photosWrap .photo-row');
                if ($rows.length <= 1) {
                    $rows.find('input[type="text"]').val('');
                    $rows.find('input[type="file"]').val('');
                    return;
                }
                $(this).closest('.photo-row').remove();
            });
        })();
    </script>
@endsection

@section('styles')
@endsection
<!-- /Page Wrapper -->

