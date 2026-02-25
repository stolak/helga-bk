
<!--Category name-->
	<li class="list-header">Navigation</li>
	<!--Menu list item-->
	<li class="active-sub">
		<a href="{{url('/')}}">
			<i class="demo-pli-home"></i>
			<span class="menu-title">Dashboard</span>
			<i class="arrow"></i>
		</a>
	</li>
	<li class="list-divider"></li>
	<!--Menu list item-->
        <!--link--> 
          @php
          
            if(Session::get('usertype') == '1')
            {
              $userModule = DB::table('assign_user_role')
                ->join('user_role', 'user_role.roleID', '=', 'assign_user_role.roleID')
                ->join('assign_module_role', 'assign_module_role.roleID', '=', 'assign_user_role.roleID')
                ->join('module', 'module.moduleID', '=', 'assign_module_role.moduleID')
                ->whereRaw('module.moduleID = assign_module_role.moduleID')
                ->distinct()
                ->select('module.modulename', 'module.moduleID', 'user_role.rolename')
                ->orderBy('module.module_rank', 'ASC')
                ->get();
            }else{
              $userModule = DB::table('tblassign_role_module')
                ->join('tblsubmodule', 'tblsubmodule.id', '=', 'tblassign_role_module.submoduleid')
                ->join('tblmodule', 'tblmodule.id', '=', 'tblsubmodule.moduleid')
                ->where('tblassign_role_module.roleid', '=', Auth::user()->userrole)
                ->distinct()
                ->select('tblmodule.module', 'tblmodule.id')
                ->orderBy('tblmodule.module_rank', 'ASC')
                ->get();
            }
          @endphp
          @if($userModule)
            @foreach($userModule as $module)
              @php
                if(Session::get('usertype') == 'Technical')
                {
                  $userLinks = DB::table('submodule')
                    ->join('module', 'module.moduleID', '=', 'submodule.moduleID')
                    ->where('submodule.moduleid', '=', $module->id)
                    ->distinct()
                    ->orderBy('module.module_rank', 'Asc')
                    ->orderBy('submodule.sub_module_rank', 'Asc')
                    ->get();
                }else{
                    $userLinks =  DB::table('tblassign_role_module')
                ->join('tblsubmodule', 'tblsubmodule.id', '=', 'tblassign_role_module.submoduleid')
                ->join('tblmodule', 'tblmodule.id', '=', 'tblsubmodule.moduleid')
                ->where('tblassign_role_module.roleid', '=', Auth::user()->userrole)
                ->where('tblsubmodule.moduleid', '=',$module->id)
                ->distinct()
                ->select('tblsubmodule.*')
                ->orderBy('tblsubmodule.rank', 'ASC')
                ->get();
                    
                    
                    
                }
              @endphp
				<li>
					<a href="#">
						<i class="demo-pli-pen-5"></i>
						<span class="menu-title">{{$module->module}}</span>
						<i class="arrow"></i>
					</a>
					<!--Submenu-->
					<ul class="collapse">
					@foreach($userLinks as $route)
						<li><a href="{!! url($route->links) !!}">{{ $route->submodule }}</a></li>
					@endforeach
					</ul>
				</li>			  
            @endforeach
          @endif
        <!--endif-->
       
      
