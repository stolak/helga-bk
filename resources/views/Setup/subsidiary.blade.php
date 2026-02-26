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
                        <h3 class="page-title">Subsidiary Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Subsidiary Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('subsidiary-setup') }}" class="btn btn-sm btn-secondary">New</a>
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
                                {{ $edit ? 'Edit Subsidiary' : 'Create Subsidiary' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" name="subsidiaryForm" id="subsidiaryForm">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">

                                <div class="form-group">
                                    <label>Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" class="form-control"
                                        value="{{ old('slug', $edit->slug ?? '') }}" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $edit->name ?? '') }}" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Short Name</label>
                                    <input type="text" name="shortName" class="form-control"
                                        value="{{ old('shortName', $edit->shortName ?? '') }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Logo (path/url)</label>
                                    <input type="text" name="logo" class="form-control"
                                        value="{{ old('logo', $edit->logo ?? '') }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Image (path/url)</label>
                                    <input type="text" name="image" class="form-control"
                                        value="{{ old('image', $edit->image ?? '') }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Icon (path/url)</label>
                                    <input type="text" name="icon" class="form-control"
                                        value="{{ old('icon', $edit->icon ?? '') }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Tagline</label>
                                    <input type="text" name="tagline" class="form-control"
                                        value="{{ old('tagline', $edit->tagline ?? '') }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Slogan</label>
                                    <input type="text" name="slogan" class="form-control"
                                        value="{{ old('slogan', $edit->slogan ?? '') }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Overview</label>
                                    <textarea name="overview" class="form-control" rows="3">{{ old('overview', $edit->overview ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Vision</label>
                                    <textarea name="vision" class="form-control" rows="3">{{ old('vision', $edit->vision ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Mission</label>
                                    <textarea name="mission" class="form-control" rows="3">{{ old('mission', $edit->mission ?? '') }}</textarea>
                                </div>

                                <hr>

                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="mb-0">Subsidiary Activities</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="addActivityBtn">
                                        Add activity
                                    </button>
                                </div>

                                <div id="activitiesWrap" class="mt-3">
                                    @php
                                        $activityValues = old('activities');
                                        if (!is_array($activityValues)) {
                                            $activityValues = $edit
                                                ? $edit->activities->pluck('activities')->toArray()
                                                : [''];
                                        }
                                        if (count($activityValues) === 0) {
                                            $activityValues = [''];
                                        }
                                    @endphp

                                    @foreach ($activityValues as $i => $val)
                                        <div class="input-group mb-2 activity-row">
                                            <input type="text" class="form-control" name="activities[]"
                                                value="{{ $val }}" placeholder="e.g. Manufacturing, Consulting, ..."
                                                autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-danger remove-activity" type="button">
                                                    Remove
                                                </button>
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
                            <h5 class="card-title mb-0">Subsidiaries</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Slug</th>
                                            <th>Name</th>
                                            <th>Activities</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subsidiaries as $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{ $s->slug }}</td>
                                                <td>{{ $s->name }}</td>
                                                <td>{{ $s->activities_count }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('subsidiary-setup?edit=' . $s->id) }}">
                                                        Edit
                                                    </a>

                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this subsidiary? This will also remove all its activities.')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $s->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No subsidiaries yet.</td>
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
                                <h5 class="card-title mb-0">Current Activities ({{ $edit->name }})</h5>
                            </div>
                            <div class="card-body">
                                @if ($edit->activities && $edit->activities->count() > 0)
                                    <ul class="mb-0">
                                        @foreach ($edit->activities as $a)
                                            <li>{{ $a->activities }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted mb-0">No activities.</p>
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
                <div class="input-group mb-2 activity-row">
                    <input type="text" class="form-control" name="activities[]" value="" placeholder="e.g. Manufacturing, Consulting, ..." autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger remove-activity" type="button">Remove</button>
                    </div>
                </div>`;
            }

            $('#addActivityBtn').on('click', function() {
                $('#activitiesWrap').append(rowHtml());
            });

            $(document).on('click', '.remove-activity', function() {
                var $rows = $('#activitiesWrap .activity-row');
                if ($rows.length <= 1) {
                    $rows.find('input').val('');
                    return;
                }
                $(this).closest('.activity-row').remove();
            });
        })();
    </script>
@endsection

@section('styles')
@endsection
<!-- /Page Wrapper -->

