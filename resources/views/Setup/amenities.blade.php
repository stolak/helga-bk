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
                        <h3 class="page-title">Amenities Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Amenities Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('amenities-setup') }}" class="btn btn-sm btn-secondary">New</a>
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
                                {{ $edit ? 'Edit Amenity' : 'Create Amenity' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" name="amenityForm" id="amenityForm">
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
                                        placeholder="e.g. fa fa-check or any icon key">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ old('description', $edit->description ?? '') }}</textarea>
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
                                            <img src="{{ $edit->image }}" alt="amenity image" class="img-fluid"
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
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Amenities</h5>
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
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($amenities as $a)
                                            <tr>
                                                <td>{{ $a->id }}</td>
                                                <td>{{ $a->title }}</td>
                                                <td class="text-truncate" style="max-width: 140px;">{{ $a->icon }}</td>
                                                <td>
                                                    @if ($a->image)
                                                        <a href="{{ $a->image }}" target="_blank">View</a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('amenities-setup?edit=' . $a->id) }}">
                                                        Edit
                                                    </a>

                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this amenity?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $a->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No amenities yet.</td>
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

