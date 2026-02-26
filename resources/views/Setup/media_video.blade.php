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
                        <h3 class="page-title">Media Video Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Media Video Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('media-video-setup') }}" class="btn btn-sm btn-secondary">New</a>
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
                                {{ $edit ? 'Edit Video' : 'Create Video' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" name="videoForm" id="videoForm">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">

                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title', $edit->title ?? '') }}" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $edit->description ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Video URL <span class="text-danger">*</span></label>
                                    <input type="text" name="url" class="form-control"
                                        value="{{ old('url', $edit->url ?? '') }}" placeholder="https://..." autocomplete="off"
                                        required>
                                    <small class="text-muted">URL is required; videos are not uploaded here.</small>
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
                            <h5 class="card-title mb-0">Videos</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>URL</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($videos as $v)
                                            <tr>
                                                <td>{{ $v->id }}</td>
                                                <td>{{ $v->title }}</td>
                                                <td class="text-truncate" style="max-width: 260px;">
                                                    <a href="{{ $v->url }}" target="_blank">{{ $v->url }}</a>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('media-video-setup?edit=' . $v->id) }}">
                                                        Edit
                                                    </a>

                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this video?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $v->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No videos yet.</td>
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
                                <h5 class="card-title mb-0">Current Video</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-2"><strong>{{ $edit->title }}</strong></div>
                                <div class="text-muted mb-2">{{ $edit->description }}</div>
                                <div><a href="{{ $edit->url }}" target="_blank">{{ $edit->url }}</a></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection

@section('styles')
@endsection
<!-- /Page Wrapper -->

