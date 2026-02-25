@extends('layouts.layout')
@section('pageTitle')
    New User
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">User Form</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Any Forms</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
@endsection
@section('content')

    <!--- content comes here -->

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->

        <div id="page-content">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Users management</h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Error!</strong>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Success!</strong>
                            {{ session('msg') }}
                        </div>
                    @endif

                    @if(session('err'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Not Allowed ! </strong>
                            {{ session('err') }}
                        </div>
                     @endif

                <!-- Inline Form  -->
                    <!--===================================================-->
                    <form method="post" action="{{ url('create-user') }}">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control " name="name" value="{{ old('name') }}" autocomplete="off">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control " value="{{ old('username') }}" autocomplete="off">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control " name="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
					<select name='role' class="form-control">
                                      <option value=""></option>
                                      @foreach($roles as $list)
                                      <option value="{{$list->roleID}}">{{$list->rolename}}</option>
                                      @endforeach
                                      </select>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Branch</label>
					                <select name='branch' class="form-control">
                                      @foreach($Branches as $list)
                                      <option value="{{$list->id}}">{{$list->branch}}</option>
                                      @endforeach
                                      </select>
                                       
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control " autocomplete="off">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                                    </div>
                                </div>

                            </div>
                      
                        <div class="panel-footer text-right">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                    <!--===================================================-->
                    <!-- End Inline Form  -->
<div class="table-responsive col-md-12" style="font-size: 12px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight" >
                    <thead>
                        <tr bgcolor="#c7c7c7">
            <th>S/N</th>
            <th>Username</th>
            <th>Names</th>
            <th>Branch</th>
            <th>User Roles</th>
            <th>Email Address</th>
            <th>Status</th>
            <th>Action</th>
            
          </tr>
        </thead>
          <tbody>
        
          @php
          $i=1;
          @endphp
            
            @foreach($RegisteredUser as $pv)     
       <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $pv->username }}</td>
            <td>{{ $pv->name }} </td>
            <td>{{ $pv->Branch}}</td>
            <td>{{ $pv->Role}}</td>
            <td>{{ $pv->email}}</td>
            <td>{{ $pv->status}}</td>
            <td><a href="javascript: updateuser('{{$pv->id}}','{{$pv->username}}','{{$pv->name}}','{{$pv->email}}','{{$pv->userrole}}','{{$pv->status}}' ,'{{$pv->branch_id}}')" data-toggle="tooltip" data-placement="bottom" title="Edit Info" class="btn btn-primary float-right glyphicon glyphicon-edit"></a>
             </td>
               
       </tr>
             @endforeach
          </tbody>      
      </table>
       <hr />
      <div align="right">
         
      </div>
      <div class="hidden-print"></div>
    </div>
                </div>
            </div>

        </div>
        <!--/// content end here -->
    </div>
    </div>
<div id="editmodal" class="modal fade">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">User profile Update</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal"  role="form" method="POST"  action="{{ url('/user/update') }}">
                {{ csrf_field() }}
        <div class="modal-body"> 
        
            <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label class="control-label">User Name</label>
                <input type="text" class="form-control"   id="username2" readonly>
                </div>
            </div>
             <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label class="control-label">Full Name</label>
                <input type="text" class="form-control" value="" name="names" id="names2" >
                </div>
            </div>
            <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label class="control-label">email</label>
                <input type="text" class="form-control" value="" name="email" id="email2" >
                </div>
            </div>
             <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label class="control-label">New Password</label>
                <input type="password" name="password" class="form-control" >
                </div>
            </div>
            <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label for="userName">Role Privilege</label>
                <select class="form-control" id="roleedit" name="role" required>                                         
	                <option value=""> Select Role Privilege</option>
	                 @foreach ($roles as $j)
	                <option value="{{$j->roleID}}"> {{$j->rolename}}</option>
	                @endforeach
	                  
	            </select>
                </div>
            </div>
            <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label for="userName">Branch</label>
                <select class="form-control" id="branchedit" name="branch" required>                                         
	                 @foreach ($Branches as $j)
	                <option value="{{$j->id}}"> {{$j->branch}}</option>
	                @endforeach
	                  
	            </select>
                </div>
            </div>
            <div class="form-group" style="margin: 0 10px;">
                <div class="col-sm-12">
                <label class="control-label">User Status</label>
                <select  class="form-control" id="status"  name="status" >
                     <option value="">--select--</option>
                          @foreach($StatusList as $list)
                     <option value="{{ $list->id }}">{{ $list->status }}</option>
                          @endforeach
                    </select>
                </div>
            </div>
        </div>
        
            <div class="modal-footer">
                <input type="hidden" class="form-control"  name="userid" id="userid" >
                <button type="Submit" class="btn btn-success" name="priceupdate">Update</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </form>
            
        </div>
        
      </div>
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.autocomplete.min.js') }}" ></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<script>

 function updateuser(id, username,names,email,role,status,branch){
    document.getElementById('userid').value = id;
    document.getElementById('username2').value = username;
    document.getElementById('names2').value = names;
    document.getElementById('email2').value = email;
     document.getElementById('roleedit').value = role;
      document.getElementById('status').value = status;
      document.getElementById('branchedit').value = branch;
    
    $("#editmodal").modal('show')
      
   }
   
</script>


@stop