@if(Auth::user()->usertype==1)	<li class="list-divider"></li>
	<li class="active-sub">
		<a href="#">
			<i class="demo-pli-home"></i>
			<span class="menu-title">Technical </span>
			<i class="arrow"></i>
		</a>
		<ul class="collapse">
			<li><a href="{{url('/sub-module/create')}}">Manage Sub-module</a></li>
			<li><a href="{{url('/module/create')}}">Manage Module</a></li>
		</ul>
	</li>
	@endif
	
 