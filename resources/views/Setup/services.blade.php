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
                        <h3 class="page-title">Services Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Services Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('services-setup') }}" class="btn btn-sm btn-secondary">New</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            @include('_partialView.nofication')

            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                {{ $edit ? 'Edit Service' : 'Create Service' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" name="serviceForm" id="serviceForm">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">

                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title', $edit->title ?? '') }}" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="text" name="icon" class="form-control"
                                        value="{{ old('icon', $edit->icon ?? '') }}" autocomplete="off"
                                        placeholder="e.g. fa fa-star or any icon key">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ old('description', $edit->description ?? '') }}</textarea>
                                </div>

                                @php
                                    $tagsValue = old('tags', null);
                                    if ($tagsValue === null && $edit && isset($edit->tags)) {
                                        $decoded = json_decode($edit->tags, true);
                                        $tagsValue = json_last_error() === JSON_ERROR_NONE ? json_encode($decoded) : $edit->tags;
                                    }
                                @endphp

                                <div class="form-group">
                                    <label>Tags (JSON array or comma-separated)</label>
                                    <textarea name="tags" class="form-control" rows="2"
                                        placeholder='["Families","Students","Seniors","Professionals"]'>{{ $tagsValue }}</textarea>
                                    <small class="text-muted">
                                        Nullable. Examples: <code>["Families","Students"]</code> or <code>Families, Students</code>
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Image (upload)</label>
                                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.gif,.svg,.webp">
                                    <small class="text-muted">Uploaded image URL is saved into <code>image</code>.</small>
                                </div>

                                @if ($edit && $edit->image)
                                    <div class="form-group">
                                        <label class="d-block">Current Image</label>
                                        <div class="border rounded p-2">
                                            <img src="{{ $edit->image }}" alt="service image" class="img-fluid"
                                                style="max-height: 160px; object-fit: cover; width: 100%;">
                                            <div class="small mt-2 text-truncate">
                                                <a href="{{ $edit->image }}" target="_blank">{{ $edit->image }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="text-right mt-3">
                                    @if ($edit)
                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                    @else
                                        <button type="submit" class="btn btn-primary" name="addnew">Save</button>
                                    @endif
                                </div>
                            </form>

                            @if ($edit)
                                <hr>
                                <div class="form-group mb-2">
                                    <label class="mb-1">Additional Images (multiple upload)</label>
                                    <small class="text-muted d-block">
                                        These images are stored in <code>service_images</code> and can be unlimited.
                                    </small>
                                </div>

                                <form method="post" enctype="multipart/form-data"
                                    style="border: 1px dashed #ddd; padding: 12px; border-radius: 6px;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="serviceId" value="{{ $edit->id }}">
                                    <div class="form-group mb-2">
                                        <input type="file" name="images[]" class="form-control"
                                            accept=".jpg,.jpeg,.png,.gif,.svg,.webp" multiple required>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-sm btn-secondary" name="add_service_images">
                                            Upload Images
                                        </button>
                                    </div>
                                </form>

                                <div class="mt-3">
                                    <label class="d-block mb-2">Current Additional Images</label>
                                    @if (isset($editImages) && count($editImages) > 0)
                                        <div class="row">
                                            @foreach ($editImages as $img)
                                                <div class="col-6 mb-3">
                                                    <div class="border rounded p-2">
                                                        <a href="{{ $img->images }}" target="_blank">
                                                            <img src="{{ $img->images }}" alt="service image"
                                                                class="img-fluid"
                                                                style="height: 120px; width: 100%; object-fit: cover;">
                                                        </a>
                                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                                            <div class="small text-truncate" style="max-width: 170px;">
                                                                <a href="{{ $img->images }}" target="_blank">{{ $img->images }}</a>
                                                            </div>
                                                            <form method="post" style="display:inline-block"
                                                                onsubmit="return confirm('Delete this image?')">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $img->id }}">
                                                                <input type="hidden" name="serviceId" value="{{ $edit->id }}">
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    name="delete_service_image">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-muted">No additional images yet.</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Services</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Icon</th>
                                            <th>Image</th>
                                            <th>Tags</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($services as $s)
                                            @php
                                                $tagPreview = '';
                                                if (isset($s->tags) && $s->tags) {
                                                    $d = json_decode($s->tags, true);
                                                    if (json_last_error() === JSON_ERROR_NONE && is_array($d)) {
                                                        $tagPreview = implode(', ', $d);
                                                    } else {
                                                        $tagPreview = (string) $s->tags;
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{ $s->title }}</td>
                                                <td class="text-truncate" style="max-width: 120px;">{{ $s->icon }}</td>
                                                <td>
                                                    @if ($s->image)
                                                        <a href="{{ $s->image }}" target="_blank">View</a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td class="text-truncate" style="max-width: 220px;">
                                                    {{ $tagPreview ?: '—' }}
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('services-setup?edit=' . $s->id) }}">
                                                        Edit
                                                    </a>

                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this service?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $s->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No services yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection

@section('styles')
@endsection
<!-- /Page Wrapper -->

