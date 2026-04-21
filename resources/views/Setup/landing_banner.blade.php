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
                        <h3 class="page-title">Landing Banner Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Landing Banner Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('landing-banner-setup') }}" class="btn btn-sm btn-secondary">New</a>
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
                                {{ $edit ? 'Edit Banner' : 'Create Banner' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" name="landingBannerForm" id="landingBannerForm">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">

                                <div class="form-group">
                                    <label>Message <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control" rows="5" required
                                        maxlength="5000">{{ old('message', $edit->message ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Rank</label>
                                    <input type="number" name="ranks" class="form-control" min="0"
                                        value="{{ old('ranks', $edit->ranks ?? '') }}" autocomplete="off"
                                        placeholder="Lower numbers show first">
                                    <small class="text-muted">Ordering uses rank ascending (lower first).</small>
                                </div>

                                @if ($edit)
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            @php
                                                $currentStatus = old('status', $edit->status ?? 'Active');
                                            @endphp
                                            <option value="Active" {{ $currentStatus === 'Active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="Inactive" {{ $currentStatus === 'Inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                        <small class="text-muted">New banners are Active by default.</small>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label>Image (upload)</label>
                                    <input type="file" name="image" class="form-control"
                                        accept=".jpg,.jpeg,.png,.gif,.svg,.webp">
                                </div>

                                @if ($edit && $edit->image)
                                    <div class="form-group">
                                        <label class="d-block">Current Image</label>
                                        <div class="border rounded p-2">
                                            <img src="{{ $edit->image }}" alt="landing banner image" class="img-fluid"
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
                            <h5 class="card-title mb-0">Banners</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rank</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($banners as $b)
                                            <tr>
                                                <td>{{ $b->id }}</td>
                                                <td>{{ $b->ranks ?? '—' }}</td>
                                                <td class="text-truncate" style="max-width: 300px;">{{ $b->message }}</td>
                                                <td>
                                                    @if (($b->status ?? 'Active') === 'Active')
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($b->image)
                                                        <a href="{{ $b->image }}" target="_blank">View</a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('landing-banner-setup?edit=' . $b->id) }}">
                                                        Edit
                                                    </a>

                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this landing banner?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $b->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No banners yet.</td>
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

