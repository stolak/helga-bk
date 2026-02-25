@extends('layouts.loginlayout')

@section('content')
<div class="container-login100" style="background-image: url('img/al-islami-business-accounts.jpg');">
<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
		@php $appinfo=DB::table('tblcompanyinfo')->first(); @endphp
			<form class="login100-form validate-form" action="{{ url('/login') }}" method="POST">
			{{ csrf_field() }}
				<span class="login100-form-title p-b-37">
				{{$appinfo->company_name?? ''}}
				</span>
				<span class="login100-form-title p-b-37">
				{{$appinfo->solution?? 'MBR Finance Management System'}}
				</span>
			

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username">
					<input class="input100" type="text" name="username" placeholder="username" value="{{ old('username') }}">
					<span class="focus-input100"></span>
					@if ($errors->has('username'))
					<span class="focus-input100"><strong>{{ $errors->first('username') }}</strong></span>
					@endif
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="password" placeholder="password">
					<span class="focus-input100"></span>
					@if ($errors->has('password'))
						<span class="focus-input100"><strong>{{ $errors->first('password') }}</strong></span>
					@endif
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit">
						Sign In
					</button>
				</div>

			</form>

			
		</div>
	</div>
@endsection
