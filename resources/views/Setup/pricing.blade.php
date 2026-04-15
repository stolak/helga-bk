<!-- Page Wrapper -->
@extends('layouts.layout')
@section('pageTitle')
    {{ env('Page_Title') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Pricing Setup</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Pricing Setup</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('pricing-setup') }}" class="btn btn-sm btn-secondary">New</a>
                    </div>
                </div>
            </div>

            @include('_partialView.nofication')

            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                {{ $editCard ? 'Edit Card Assignment' : 'Create Card Assignment' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $editCard->id ?? '' }}">

                                <div class="form-group">
                                    <label>Card Position <span class="text-danger">*</span></label>
                                    @php
                                        $pos = old('cardPosition', $editCard->cardPosition ?? '');
                                    @endphp
                                    <select name="cardPosition" class="form-control" required>
                                        <option value="">-- select --</option>
                                        @foreach (['Card1', 'Card2', 'Card3', 'Card4'] as $p)
                                            <option value="{{ $p }}" {{ $pos === $p ? 'selected' : '' }}>
                                                {{ $p }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    @php
                                        $catId = old('category', $editCard->category ?? '');
                                    @endphp
                                    <input type="text" name="category" class="form-control"
                                        value="{{ $catId }}" autocomplete="off" required
                                        placeholder="e.g. Basic, Standard, Premium">
                                    <small class="text-muted">
                                        Saves to <code>pricing_category.category</code> as text (typically the category name). If you previously stored a numeric id here, the list will still display the friendly name when possible.
                                    </small>
                                </div>

                                <div class="text-right mt-3">
                                    @if ($editCard)
                                        <button type="submit" class="btn btn-primary" name="update_card">Update</button>
                                    @else
                                        <button type="submit" class="btn btn-primary" name="addnew_card">Save</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                {{ $editPricing ? 'Edit Pricing' : 'Create Pricing' }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $editPricing->id ?? '' }}">

                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    @php
                                        $selectedCat = old('categoryId', $editPricing->categoryId ?? '');
                                    @endphp
                                    <select name="categoryId" class="form-control" required>
                                        <option value="">-- select --</option>
                                        @foreach (($categoryOptions ?? []) as $opt)
                                            <option value="{{ $opt->id }}" {{ (string) $selectedCat === (string) $opt->id ? 'selected' : '' }}>
                                                ({{ $opt->id }}) {{ $opt->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">
                                        Value stored in <code>pricing.categoryId</code> is the selected <code>pricing_category.id</code>.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $editPricing->description ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="amount" class="form-control"
                                        value="{{ old('amount', $editPricing->amount ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    @php
                                        $st = old('status', $editPricing->status ?? 'Active');
                                    @endphp
                                    <select name="status" class="form-control" required>
                                        <option value="Active" {{ $st === 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ $st === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="text-right mt-3">
                                    @if ($editPricing)
                                        <button type="submit" class="btn btn-primary" name="update_pricing">Update</button>
                                    @else
                                        <button type="submit" class="btn btn-primary" name="addnew_pricing">Save</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Card Assignments</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Card</th>
                                            <th>Category</th>
                                            <th>Pricing Items</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cards as $c)
                                            <tr>
                                                <td>{{ $c->id }}</td>
                                                <td>{{ $c->cardPosition }}</td>
                                                <td>
                                                    @if (!empty($c->categoryName))
                                                        {{ $c->categoryName }}
                                                    @elseif (!empty($c->categoryId))
                                                        @php
                                                            $pc = collect($categoryOptions ?? [])->firstWhere('id', (int) $c->categoryId);
                                                        @endphp
                                                        {{ $pc->category ?? ('#' . $c->categoryId) }}
                                                    @else
                                                        {{ $c->category }}
                                                    @endif
                                                </td>
                                                <td class="text-truncate" style="max-width: 220px;">
                                                    {{ ($c->pricingCount ?? 0) }}
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('pricing-setup?edit_card=' . $c->id) }}">
                                                        Edit
                                                    </a>
                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this card assignment?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $c->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete_card">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No assignments yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Pricing</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pricing as $p)
                                            <tr>
                                                <td>{{ $p->id }}</td>
                                                <td class="text-truncate" style="max-width: 240px;">
                                                    {{ $p->categoryName ?? $p->categoryId }}
                                                </td>
                                                <td>{{ $p->amount }}</td>
                                                <td>
                                                    @if (($p->status ?? 'Active') === 'Active')
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ url('pricing-setup?edit_pricing=' . $p->id) }}">
                                                        Edit
                                                    </a>
                                                    <form method="post" style="display:inline-block"
                                                        onsubmit="return confirm('Delete this pricing? This will also remove any card assignments pointing to it.')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete_pricing">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No pricing yet.</td>
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

