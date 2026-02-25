@extends('layouts.visitorlayout')
@section('pageTitle')
    Supplier
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
                                    <label class="control-label">Title</label>
                                    <?php if($supplier=='') $supplier= old('supplier'); ?>
                                    <input type="text" class="form-control"  value="{{$supplier}}" required name="supplier">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php if($phoneno=='') $phoneno= old('phoneno'); ?>
                                    <label class="control-label">Surname<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required value="{{$phoneno}}" name="phoneno">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">First Name<span class="text-danger">*</span></label>
                                    <?php if($address=='') $address= old('address'); ?>
                                    <input type="text" class="form-control" required value="{{$address}}" name="address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Other Name</label>
                                    <?php if($email=='') $email= old('email'); ?>
                                    <input type="text" class="form-control" required value="{{$email}}" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Phone No<span class="text-danger">*</span></label>
                                    <?php if($address=='') $address= old('address'); ?>
                                    <input type="text" class="form-control" required value="{{$address}}" name="address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Alternative Phone No</label>
                                    <?php if($email=='') $email= old('email'); ?>
                                    <input type="text" class="form-control" required value="{{$email}}" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">e-mail<span class="text-danger">*</span></label>
                                    <?php if($address=='') $address= old('address'); ?>
                                    <input type="text" class="form-control" required value="{{$address}}" name="address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Alternative e-mail</label>
                                    <?php if($email=='') $email= old('email'); ?>
                                    <input type="text" class="form-control" required value="{{$email}}" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Contact Address<span class="text-danger">*</span></label>
                                    <?php if($address=='') $address= old('address'); ?>
                                    <textarea id="contactaddress" name="contactaddress" class="form-control" style="height:150px;" required  rows="3" >{{ $address }} </textarea>
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
                      <label class="control-label"><h5>Supplier Code: </h5></label>
                      <input type="text" class="form-control" id="scode"  readonly>
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Supplier Name: </h5></label>
                      <input type="text" class="form-control" id="sup" name="supplier">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Address: </h5></label>
                      <input type="text" class="form-control" id="address" name="address">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Phone No: </h5></label>
                      <input type="text" class="form-control" id="phoneno" name="phoneno">
                        </div>
                      </div>
                       <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>email: </h5></label>
                      <input type="text" class="form-control" id="email" name="email">
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
              <h4 class="modal-title">Delete Supplier Record</h4>
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

    function editfunc(id,scode,sup,address,phoneno,email)
    {
        document.getElementById('id').value = id;
        document.getElementById('scode').value = scode;
        document.getElementById('sup').value = sup;
        document.getElementById('address').value = address;
        document.getElementById('phoneno').value = phoneno;
         document.getElementById('email').value = email;
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
