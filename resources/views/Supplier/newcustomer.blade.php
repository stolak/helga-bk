@extends('layouts.layout')
@section('pageTitle')
    Registration
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Registration</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Customer Registration</a></li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="boxed">
        <div id="page-content">
        <div class="panel">
            <div class="panel-body">
              @include('_partialView.nofication')
	        <div class="panel-footer text-left">
                <button class="btn btn-success" type="button" onclick="Addnew()">Add New</button>
            </div>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Customer Name</label>
                                    <input type="text" class="form-control"  value="" name="customer" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" class="form-control"  value="" name="email" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Phone No</label>
                                    <input type="text" class="form-control"  value="" name="phoneno" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input type="text" class="form-control"  value="" name="address" >
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-left">
                            <button class="btn btn-success" type="submit" name="addnew">Create</button>
                        </div>
                    </div>
                </form>
            
             <!-- end display selected inventory detail if exist-->
                <!--===================================================-->
                <!-- End Inline Form  -->
            <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Customer Code</th>
		            <th>Full Name</th>
		            <th>Phone No</th>
		            <th>Email Address</th>
		            <th>Purchase Target</th>
		            <th>Rebate%</th>
		            <th>Defined Incentive</th>
		            <th></th>
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($Customers as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td> {{$list->customer_number}}</td>
		               <td> {{$list->firstname}} {{$list->middlename}} {{$list->surname}}</td>
		               <td> {{$list->phoneno}}</td>
		               <td> {{$list->email}}</td>
		               <td> {{number_format($list->purchase_target?? 0,2)}}</td>
		               <td> {{$list->rebate_percentage}}</td>
		               <td> {{number_format($list->rebate_value?? 0,2)}}</td>
		               <td>
		               <a onclick="editfunc('{{$list->id}}','{{$list->customer_number}}','{{$list->firstname}}','{{$list->phoneno}}','{{$list->email}}','{{$list->address}}','{{number_format($list->purchase_target?? 0,2)}}','{{$list->rebate_percentage}}','{{number_format($list->rebate_value?? 0,2)}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
		               <a onclick="deletefunc('{{$list->id}}','{{$list->customer_number}}:{{$list->firstname}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
		               </td>
		              
		               </tr>
		            @endforeach
		            </tbody>
		      </table>
		     </div>
            </div>
        </div>
<!--Edit customer information-->
<div id="editModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit record</h4>
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
                      <label class="control-label"><h5>Customer Code: </h5></label>
                      <input type="text" class="form-control" id="code" readonly>
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label"><h5>Customer name: </h5></label>
                            <input type="text" class="form-control" id="e-customer" name="customer">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label"><h5>Phone No: </h5></label>
                            <input type="text" class="form-control" id="e-phoneno" name="phoneno">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label"><h5>Email: </h5></label>
                            <input type="text" class="form-control" id="e-email" name="email">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label"><h5>Address: </h5></label>
                            <input type="text" class="form-control" id="e-address" name="address">
                        </div>
                      </div>
                      <div class="col-sm-4">
			             <div class="form-group">
                            <label class="control-label"><h5>Target Purchase: </h5></label>
                            <input type="text" class="form-control" id="e-purchase_target" name="purchase_target" onblur='ValidateInput("e-purchase_target")'>
                        </div>
                      </div>
                      <div class="col-sm-4">
			             <div class="form-group">
                            <label class="control-label"><h5>Rebate%: </h5></label>
                            <input type="text" class="form-control" id="e-rebate_percentage" name="rebate_percentage">
                        </div>
                      </div>
                      <div class="col-sm-4">
			             <div class="form-group">
                            <label class="control-label"><h5>Rebate value: </h5></label>
                            <input type="text" class="form-control" id="e-rebate_value" name="rebate_value" onblur='ValidateInput("e-rebate_value")'>
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
        <!--// End edit customer information-->
     <div id="deleteModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="deleteid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h3 style="color:black;">Do you really want to delete <div id="content5"></div>?</h3></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="delinv" class="btn btn-success">Yes</button>
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
<form method="post"  id="noform" name="noform">
{{ csrf_field() }}
 <input type="hidden" class="form-control" id="noid" name="id" value="">

</form>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
label {
  color: black
  text-shadow: 1px 1px 2px #fff;
}
</style>
@stop
@section('scripts')
 

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>

   
    
    function editfunc(id,code,customer,phoneno,email,address,purchase_target,rebate_percentage,rebate_value)
    {
        document.getElementById('id').value = id;
         document.getElementById('code').value = code;
         document.getElementById('e-customer').value = customer;
         document.getElementById('e-phoneno').value = phoneno;
         document.getElementById('e-email').value = email;
         document.getElementById('e-address').value = address;
         document.getElementById('e-purchase_target').value = purchase_target;
         document.getElementById('e-rebate_percentage').value = rebate_percentage;
         document.getElementById('e-rebate_value').value = rebate_value;
        
        
        $("#editModal").modal('show')
    }
   function deletefunc(id,item)
    {
        document.getElementById('deleteid').value = id;
        document.getElementById('content5').innerHTML = item;
                     
        $("#deleteModal").modal('show')
    }
    
     function deletePfunc(id,f)
    {
        //alert("djfjf");
        document.getElementById('deletepid').value = id;
        document.getElementById('contentpid').innerHTML = f;
                     
        $("#deleteModalp").modal('show')
    }
     function deleteSfunc(id,f)
    {
        //alert("djfjf");
        document.getElementById('deletesid').value = id;
        document.getElementById('contentsid').innerHTML = f;
                     
        $("#deleteModals").modal('show')
    }
    function Addnew()
    {
                     
        $("#newModal").modal('show')
    }
    function newPformat()
    {
        $("#pnewModal").modal('show')
    }
    function newSformat()
    {
        $("#snewModal").modal('show')
    }
    function editPfunc(id,f,q,p)
    {
        document.getElementById('pid').value = id;
        document.getElementById('puformat').value = f;
        
        document.getElementById('puqty').value = q;
        
        document.getElementById('puprice').value = p;
       
        $("#pupdateModal").modal('show')
    }
    function editSfunc(id,f,q,p)
    {
        document.getElementById('sid').value = id;
        document.getElementById('suformat').value = f;
        document.getElementById('suqty').value = q;
        document.getElementById('suprice').value = p;
        $("#supdateModal").modal('show')
    }
    
    function SelectInventory(id)
    {
        document.getElementById('noid').value = id;
       document.forms["noform"].submit();
    }
 function ValidateInput(id){
    document.getElementById(id).value = parseFloat(document.getElementById(id).value.toString().replace(/\,/g,'')).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   }            
</script>



  
@stop
