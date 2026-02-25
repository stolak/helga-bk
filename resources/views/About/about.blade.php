@extends('layouts.loginlayout')

@section('content')
<div class="container">
    <h3> {{$maindata->title}}</h3>
        <hr>
        {!! $maindata->detail !!}
        <hr>
	</div>
	@endsection