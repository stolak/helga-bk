@extends('layouts.layout')
@section('pageTitle')
Add New Module
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Add Module</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#"></a></li>
            <li class="active">Add Module</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
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

        <form method="post" action="{{ url('/module/add') }}" class="form-horizontal">
          {{ csrf_field() }} 
          
          
          
          <div class="form-group">
            <label for="section" class="col-md-3 control-label">Module Name</label>
            <div class="col-md-9">
              <input id="moduleName" type="text" class="form-control" name="moduleName" value="{{ old('moduleName') }}" required>
            </div>
          </div>

          <div class="form-group">
            <label for="section" class="col-md-3 control-label">Rank</label>
            <div class="col-md-9">
              <input id="rank" type="number" class="form-control" name="rank" value="{{ old('rank') }}" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-success btn-sm pull-right">Add Module</button>
            </div>
          </div>
        </form>
        
        <div class="box-body">
  <h2 class="text-center">ALL MODULES</h2>
  <div class="row"> {{ csrf_field() }}
    <div class="col-md-12">
      <table class="table table-striped table-condensed table-bordered input-sm">
        <thead>
          <tr class="input-sm">
            <th>S/N</th>
            <th>MODULE NAME</th>
            <th>RANK</th>
            <th>DATE CREATED</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        
        @php $key = 1; @endphp
        @foreach($modules as $list)
        <tr>
          <td>{{($modules->currentpage()-1) * $modules->perpage() + $key ++}}</td>
          <td>{{strtoupper($list->module)}}</td>
          <td>{{strtoupper($list->module_rank)}}</td>
          <td>{{$list->created_at}}</td>
          <td><a href="#" title="Edit" id="{{$list->id}}" class="btn btn-success fa fa-edit edits" onclick="Editmodule('{{$list->id}}','{{$list->module}}','{{$list->module_rank}}')"></a></td>
        </tr>
        @endforeach
        </tbody> 
      </table>
       <hr />
      <div align="right">
          Showing {{($modules->currentpage()-1)*$modules->perpage()+1}}
                  to {{$modules->currentpage()*$modules->perpage()}}
                  of  {{$modules->total()}} entries
      </div>
      <div class="hidden-print">{{ $modules->links() }}</div>
    </div>
  </div>
  <!-- /.col --> 
  
</div>

</div></div></div></div>


<!-- modal bootstrap -->
<form action="{{url('/module/update')}}" method="post">
{{ csrf_field() }} 
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Module</h4>
            </div>
            <div class="modal-body">
           
                    <div class="row" style="margin-bottom: 10px;">
                     <div class="form-group">
                        <label for="section" class="col-md-3 control-label">Module Name</label>
                        <div class="col-md-9">
                          <input id="module" type="text" class="form-control" name="name" required>
                          <input id="id" type="hidden" class="form-control" name="moduleID" required>
                        </div>
                      </div>
                    </div>
                      
                    <div class="row">
                     <div class="form-group">
                       <label for="section" class="col-md-3 control-label">Rank</label>
                        <div class="col-md-9">
                          <input id="ranks" type="number" class="form-control" name="rank" value="" required>
                          
                        </div>
                      </div>
                    </div>    


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--// modal Bootstrap -->
</form>
@endsection 



@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom-style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.autocomplete.min.js') }}" ></script>


<script type="text/javascript">
function Editmodule(id,modulename,rank)
    {
    $('#module').val(modulename);
   $('#id').val(id);
   $('#ranks').val(rank);
   $("#myModal").modal('show');
   }
   
 
</script>

<script>

  $(document).ready(function(){
  
$('table tr td .edits').click(function()
{

$("#myModal").modal('show');
});

  });
</script>

@stop
