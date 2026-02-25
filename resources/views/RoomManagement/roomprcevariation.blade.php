@extends('layouts.layout')
@section('pageTitle')
    Price variation
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Price variation</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Price variation</a></li>
         
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
                            
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="update">Update</button>
                    </div>
               
                
                <!--===================================================-->
                <!-- End Inline Form  -->
<div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		        <tr bgcolor="#c7c7c7">
                    <th>S/N</th>
                    <th>Room Type</th>
                    <th>Default charge</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
		        </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($RoomType as $list)
		                           
		               <tr>
    		               <td>{{ $i++ }} </td>
    		               <td>{{ $list->room_type}} </td>
    		               <td>{{number_format($list->default_price?? 0,2, '.', ',')}} </td>
    		               <td><input type="text" class="form-control" onblur='ValidateInput("room{{$list->id}}mon")' name="room{{$list->id}}mon" id="room{{$list->id}}mon" value="{{number_format($list->Mon?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
    		               <td><input type="text" class="form-control" onblur='ValidateInput("room{{$list->id}}tue")'  name="room{{$list->id}}tue" id="room{{$list->id}}tue" value="{{number_format($list->Tue?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
    		               <td><input type="text" class="form-control"  onblur='ValidateInput("room{{$list->id}}wed")'  name="room{{$list->id}}wed" id="room{{$list->id}}wed" value="{{number_format($list->Wed?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
    		               <td><input type="text" class="form-control" onblur='ValidateInput("room{{$list->id}}thu")'  name="room{{$list->id}}thu" id="room{{$list->id}}thu" value="{{number_format($list->Thu?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
    		               <td><input type="text" class="form-control" onblur='ValidateInput("room{{$list->id}}fri")'  name="room{{$list->id}}fri" id="room{{$list->id}}fri" value="{{number_format($list->Fri?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
    		               <td><input type="text" class="form-control" onblur='ValidateInput("room{{$list->id}}sat")'  name="room{{$list->id}}sat" id="room{{$list->id}}sat" value="{{number_format($list->Sat?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
    		               <td><input type="text" class="form-control" onblur='ValidateInput("room{{$list->id}}sun")'  name="room{{$list->id}}sun"  id="room{{$list->id}}sun" value="{{number_format($list->Sun?? 0,2, '.', ',')}}"   style="text-align: right;width:100px; "></td>
		               </tr>
		            @endforeach
		            </tbody>
		                   
		      </table>
		     </div>
		      </form>
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
    function editfunc(id,cat,amount){
        document.getElementById('id').value = id;
        document.getElementById('category').value = cat;
        document.getElementById('amount').value = amount;
        $("#editModal").modal('show')
    }
    function deletefunc(id){
        document.getElementById('deleteid').value = id;
        $("#deleteModal").modal('show')
    }
    function ValidateInput(id){
    document.getElementById(id).value = parseFloat(document.getElementById(id).value.toString().replace(/\,/g,'')).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   }
</script>



  
@stop
