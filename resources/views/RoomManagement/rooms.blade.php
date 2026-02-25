@extends('layouts.layout')
@section('pageTitle')
    Room setup
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Room setup</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Room  setup</a></li>
         
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
	          <strong>Successful!</strong> {{ session('message') }}</div>
	        @endif
	        @if(session('error_message'))
	        <div class="alert alert-danger alert-dismissible" role="alert">
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
	          <strong>Error!</strong> {{ session('error_message') }}</div>
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
                <form method="post">
                {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Room type</label>
                                    <select  name="category" class="form-control">
                    				    <option value="">-Select-</option>
                    				    @foreach($RoomType as $list)
                                        <option value="{{ $list->id }}" {{ (old('category') == $list->id ||($category) == $list->id  ) ? 'selected':'' }}>{{ $list->room_type }}</option>
                                        @endforeach
                    				</select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Room number</label>
                                    <?php if($room_number=='') $room_number= old('room_number'); ?>
                                    <input type="text" class="form-control"  value="{{$room_number}}" required name="room_number">
                                </div>
                            </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Additional information</label>
                                    
                                    <input type="text" class="form-control"  value="{{$room_description}}"  name="room_description" placeholder="Optional">
                                </div>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="addnew">Create</button>
                    </div>
                </form>
                
                <!--===================================================-->
                <!-- End Inline Form  -->
<div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		          
		            <th>S/N</th>
		            <th>Room type</th>
		            <th>Room number</th>
		            <th>Default price per night</th>
		            <th>Additional information</th>
		            <th>Action</th>
		           
		            		            
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($Rooms as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td>{{ $list->room_type}} </td>
		               <td>{{ $list->room_no}} </td>
		               <td>{{ number_format($list->default_price,2)}} </td>
		               <td>{{ $list->details?? 'N/A'}} </td>
		               <td>
		               <a onclick="editfunc('{{$list->id}}','{{$list->room_type_id}}','{{$list->room_no}}','{{$list->details}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
		               <a onclick="deletefunc('{{$list->id}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
		               </td>
		              
		               </tr>
		            @endforeach
		            </tbody>
		                   
		      </table>
		     </div>
            </div>
        </div>
    <div id="editModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit room records</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="id" name="id">
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Room Type: </h5></label>
                       <select id="category" name="category" class="form-control">
            				    <option value="">-Select-</option>
            				    @foreach($RoomType as $list)
                                <option value="{{ $list->id }}" {{ (old('category') == $list->id ||($category) == $list->id  ) ? 'selected':'' }}>{{ $list->room_type }}</option>
                                @endforeach
            				</select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Room number: </h5></label>
                      <input type="text" class="form-control" id="room_number" name="room_number">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Additional information: </h5></label>
                      <input type="text" class="form-control" id="room_description" name="room_description">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
    <!--modal for deleting record-->
    <div id="deleteModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Room Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="deleteid" name="id" value="">
                                          
                      <div class="col-sm-12">
                     <center><h1 style="color:black;">Are you sure?</h1></center>
                      </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="del" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            
                </form>
            </div>
            
          </div>
    </div>
    </div>
        <!--/// content end here -->
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
<script>
    function editfunc(id,cat,room_number,room_description){
        document.getElementById('id').value = id;
        document.getElementById('category').value = cat;
        //alert(cat);
        document.getElementById('room_number').value = room_number;
        document.getElementById('room_description').value = room_description;
        $("#editModal").modal('show')
    }
    function deletefunc(id){
        document.getElementById('deleteid').value = id;
        $("#deleteModal").modal('show')
    }
</script>



  
@stop
