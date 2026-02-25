@extends('layouts.layout')
@section('pageTitle')
    Branch
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Registration</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">New Registration</a></li>
         
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
        <div align="center" class="alert alert-primary">
 			<b>New Registration </b>
 			<span class="pull-right">All fields with <span class="text-danger">*</span> are required to be filled</span>
        </div>
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
                    <div class="panel-bodyrr">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <?php if($branch=='') $branch= old('branch'); ?>
                                    <input type="text" class="form-control"  value="{{$branch}}" required name="branch">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php if($phoneno=='') $phoneno= old('phoneno'); ?>
                                    <label class="control-label">Phone No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required value="{{$phoneno}}" name="phoneno">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Contact Address<span class="text-danger">*</span></label>
                                    <?php if($address=='') $address= old('address'); ?>
                                    <textarea id="address" name="address" class="form-control" style="height:150px;" required  rows="3" >{{ $address }} </textarea>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="addnew">Register</button>
                    </div>
                </form>
                
                <!--===================================================-->
                <!-- End Inline Form  -->
<div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		          
		            <th>S/N</th>
		            <th>Branch</th>
		            <th>Phone No</th>
		            <th>Address</th>
		            <th>Action</th>
		           
		            		            
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($Braches as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td>{{ $list->branch}} </td>
		               <td>{{ $list->phonecontact}} </td>
		               <td>{{ $list->address}}</td>
		               <td>
		               <a onclick="editfunc('{{$list->id}}','{{$list->branch}}','{{$list->phonecontact}}','{{$list->address}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
		               <a onclick="deletefunc('{{$list->id}}','{{$list->branch}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
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
              <h4 class="modal-title">Edit Manufacturer Record</h4>
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
                      <label class="control-label"><h5>Branch: </h5></label>
                      <input type="text" class="form-control" id="sbranch"  name="branch">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Phone No: </h5></label>
                      <input type="text" class="form-control" id="sphoneno" name="phoneno">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Address: </h5></label>
                      <input type="text" class="form-control" id="saddress" name="address">
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
              <h4 class="modal-title">Delete  Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="deleteid" name="id">
                                          
                      <div class="col-sm-12">
                     <center><h1 style="color:black;">Are you sure <div id="contents"></div> ?</h1></center>
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

    function editfunc(id,branch,phoneno,address)
    {
        document.getElementById('id').value = id;
        document.getElementById('sbranch').value = branch;
        document.getElementById('saddress').value = address;
        document.getElementById('sphoneno').value = phoneno;
        $("#editModal").modal('show')
    }
   function deletefunc(id,sup)
    {
        document.getElementById('deleteid').value = id;
        document.getElementById('contents').innerHTML = sup;
                     
        $("#deleteModal").modal('show')
    }
    
             
</script>



  
@stop
