@extends('layouts.layout')
@section('pageTitle')
Add New Role
@endsection

@section('content')

<div class="boxed">
        <!--CONTENT CONTAINER-->
        <!--===================================================-->
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
            
             <div class="row">
      <div class="col-md-9"> <br>
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          <strong>Error!</strong> @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach </div>
        @endif                       
        
        @if(session('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          <strong>Success!</strong> {{ session('message') }}</div>
        @endif
        @if(session('error_message'))
        <div class="alert alert-error alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          <strong>Error!</strong> {{ session('error_message') }}</div>
        @endif
        <form method="post" action="{{ url('/user-role/add') }}" class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="section" class="col-md-3 control-label">Role Name</label>
            <div class="col-md-9">
              <input id="name" type="text" class="form-control" name="roleName" value="{{ old('roleName') }}" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-success btn-sm pull-right">Add Role</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="row"> {{ csrf_field() }}
      <div class="col-md-12">
        <table class="table table-striped table-condensed table-bordered input-sm">
          <thead>
            <tr class="input-sm">
              <th>S/N</th>
              <th>ROLE NAME</th>
              <th>DATE CREATED</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          
          @php $key = 1; @endphp
          @foreach($allRoles as $list)
          <tr>
            <td>{{($allRoles->currentpage()-1) * $allRoles->perpage() + $key ++}}</td>
            <td>{{strtoupper($list->rolename)}}</td>
            <td>{{$list->created_at}}</td>
            <td><a href="{{url('/user-role/edit/'.$list->roleID)}}" title="Edit" class="btn btn-success fa fa-edit"></a></td>
          </tr>
          @endforeach
          </tbody>
        </table>
        <hr />
        <div align="right">
          Showing {{($allRoles->currentpage()-1)*$allRoles->perpage()+1}}
                  to {{$allRoles->currentpage()*$allRoles->perpage()}}
                  of  {{$allRoles->total()}} entries
      </div>
      <div class="hidden-print">{{ $allRoles->links() }}</div>
      </div>
    </div>
            
            </div>
           </div>
          </div>
         </div>  


@endsection 