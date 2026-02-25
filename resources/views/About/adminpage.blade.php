@extends('layouts.layout')
@section('pageTitle')
    About
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">About</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">About</a></li>
         
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
            <div class="panel-body">
            @if(session('message'))
	        <div class="alert alert-success alert-dismissible" role="alert">
    	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
    	          <strong>Successful!</strong> {{ session('message') }}
	        </div>
	        @endif
	        @if(session('error_message'))
	        <div class="alert alert-danger alert-dismissible" role="alert">
    	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
    	          <strong>Error!</strong> {{ session('error_message') }}
    	   </div>
	        @endif
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
	        
	            <div class="row">
    <form class="form-horizontal" method="post" id="mainform" name="mainform" >
        <input type="hidden" id="id"  value="{{$id}}" name="id">
        {{ csrf_field() }} 
        
        <div class="pos col-md-2">                
            <div class="form-group" >
                <label for="title"><strong>Menu display:</strong></label>
                <input type="text"  name="menu" class="form-control col-sm-2 col-form-label" autocomplete="off"  value="{{$updatedata->menu??''}}">
            </div>
        </div >
        <div class="pos col-md-8">                
            <div class="form-group" >
                <label for="title"><strong>Heading title:</strong></label>
                <input type="text" id="title" name="title" class="form-control col-sm-2 col-form-label" autocomplete="off" value="{{$updatedata->title??''}}">
            </div>
        </div >
        <div class="pos col-md-2">                
            <div class="form-group" >
                <label for="title"><strong>Rank:</strong></label>
                <input type="text"  name="rank" class="form-control col-sm-2 col-form-label" autocomplete="off" placeholder="Optional"  value="{{$updatedata->rank??''}}">
            </div>
        </div >
        <div class="pos col-md-12"> 
            <div class="form-group">
                <label for="content"><strong>Content</strong></label>
                <textarea id="content" name="details" class="form-control" rows="10" cols="80">{{$updatedata->detail??''}}</textarea>
            </div>
            
           
        </div>
        <div class="pos col-md-12">   
          <div class="form-group">
            <label for="title"></label>
            @if($id)
              <input type="submit" class="btn btn-primary" name="update" value="Update">
              <input type="submit" class="btn btn-primary" name="cancel" value="Cancel">
              @else
              <input type="submit" class="btn btn-primary" name="add" value="Submit">
            @endif
          </div>
        </div> 
                            
    </form>
</div>
<div class="table-responsive" style="font-size: 12px;">
    <table class="table table-bordered table-striped table-highlight" >
                <thead>
                    <tr bgcolor="#c7c7c7">
                    	 <th >S/N</th> <th >Menu display</th><th >Heading Title</th><th >Details</th><th >Rank</th><th >Action</th>
                    </tr>
                </thead>
                @php $s=1; @endphp
                 @foreach($maindata as $data)
    				<tr>
            		<td>{{$s++}}</td>
            		<td>{{$data->menu}}</td>
            		<td>{{$data->title}}</td>
            		<td>{!! $data->detail !!}</td>
            		<td>{{$data->rank}}</td>
            		<td><a onclick="editfunc('{{$data->id}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp; <a onclick="deletefunc('{{$data->id}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a></td>
            	</tr>
            	@endforeach
            </table>
</div>
                <!--===================================================-->
                <!-- End Inline Form  -->
            </div>
        </div>
    </div>
</div>
 
 <div id="deleteModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Entry</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
              <h3> You are about to delete this record! Do you really want to continue?</h3>  
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="delete">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            <input type="hidden"  id="deleteid" name="delid" >
                </form>
            </div>
            
          </div>
        </div> 

@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<style>
label {
  color: black
  text-shadow: 1px 1px 2px #fff;
}
</style>
@stop
@section('scripts')

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/tinymce_ini.js')}}"></script>
<script>

    function editfunc(id)
    {
        document.getElementById('id').value = id;
        document.forms["mainform"].submit();
        return;
    }
   function deletefunc(id)
    {
        document.getElementById('deleteid').value = id;
        $("#deleteModal").modal('show')
    }
    
    
    
             
</script>



  
@stop
