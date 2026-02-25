@extends('layouts.layout')
@section('pageTitle')
    Supplier Default Price Listing
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Setup</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Inventory Setup</a></li>
         
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
	        
            <!-- display selected inventory detail if exist-->
            @if($SelectItemdetails)
                <form method="post" id="mainform" name="mainform">
                {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Brand</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->brand}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Item Category</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->category}}" readonly>
                                    
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Item Description</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->item_description}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
                                        <select class="select_picker_supplier form-control" id="supplier" data-live-search="true" name="supplier" onchange="Reload();">
                                        <option value="">--Select--</option>
                                        @foreach($Suppliers as $list)
                                        <option value="{{ $list->id }}" {{ (old('supplier') == $list->id ||($supplier) == $list->id  ) ? 'selected':'' }}>{{ $list->supplier }}({{ $list->s_code }})</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12">
                      <h5 class="form-group">Default Purchase Format</h5>
                        <div class="table-responsive" style="font-size: 11px; padding:10px;">
                            <table id="mytable" class="table table-bordered table-striped table-highlight">
                		        <thead>
                		          <tr bgcolor="#c7c7c7">
                		            <th>S/N</th>
                		            <th>Format</th>
                		            <th>{{$SelectItemdetails->format}} QTY </th>
                		            <th>price</th>
                		            <th></th>
                		          </tr>
                		        </thead>
                		        <tbody>
                		          @php $i=1; @endphp
                		            @foreach($PurchaseFormat as $list)
                		               <tr>
                    		                <td>{{ $i++ }} </td>
                    		               <td>{{$list->format}} </td>
                    		               <td>{{$list->minskuqty}} </td>
                    		               <td>{{$list->price}} </td>
                    		               <td>
                        		               <a onclick="editPfunc('{{$list->id}}','{{$list->formatid}}','{{$list->price}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
                        		               <a onclick="deletePfunc('{{$list->id}}','{{$list->format}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
                    		               </td>
                		               </tr>
                		            @endforeach
                		            <tr>
                		               <td colspan=5><div class="text-right">
                                                <button class="btn btn-success btn-xs" type="button" onclick="newPformat()"><span class="glyphicon glyphicon-plus"></span>new</button>
                                            </div> </td>
                		               
                		               </tr>
		                        </tbody>
		                    </table>
		                </div>
		                
                        
                    </div>
            </div>
            @endif
             <!-- end display selected inventory detail if exist-->
                <!--===================================================-->
                <!-- End Inline Form  -->
            <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Brand</th>
		            <th>Eventory Item</th>
		            <th>Category</th>
		            <th></th>
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($InventoryList as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td> {{$list->brand}}</td>
		               <td> {{$list->item_description}}</td>
		               <td> {{$list->category}}</td>
		               <td>
		               <a onclick="SelectInventory('{{$list->id}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
		               <a onclick="deletefunc('{{$list->id}}','{{$list->item_description}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
		               <a onclick="Compare('{{$list->id}}')" class="btn btn-success glyphicon glyphicon--scale btn-xs">Compare</a>
		               </td>
		              
		               </tr>
		            @endforeach
		            </tbody>
		      </table>
		     </div>
            </div>
        </div>
    
       
        <div id="pnewModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Purchase Price</h4>
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
                            <label class="control-label">Format</label>
                                <select  class="form-control" name="pformat" >
                                 <option value="">--Select--</option>
                                @foreach($ItemMFormat as $list)
                                 <option value="{{ $list->id}}" {{ (old('pformat') == $list->id ||($pformat) == $list->id) ? 'selected':'' }}>{{ $list->format}}</option>
                                @endforeach
                               </select>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Price</label>
                            <?php if($pprice=='') $pprice= old('pprice'); ?>
                            <input type="text" class="form-control"  value="{{$pprice}}" required name="pprice">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="purchasenew">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
         <div id="pupdateModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Purchase Price</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="pid" name="fid">
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Format</label>
                                    <select  class="form-control" name="format" id="puformat" >
                                     <option value="">--Select--</option>
                                    @foreach($ItemMFormat as $list)
                                     <option value="{{ $list->id}}" >{{ $list->format}}</option>
                                    @endforeach
                                   </select>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" class="form-control"   required name="price" id="puprice">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ppupdate">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
    <!--modal for deleting record-->
     <div id="deleteModalp" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Purchase Format</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="deletepid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h1 style="color:black;">Are you sure <div id="contentpid"></div>?</h1></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="delp" class="btn btn-success">Yes</button>
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


$('.select_picker_supplier').selectpicker({
          style: 'btn-default',
          size: 4
        });
     function deletePfunc(id,f)
    {
        
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
   
    function newPformat()
    {
        $("#pnewModal").modal('show')
    }
    
    function editPfunc(id,f,p)
    {
        document.getElementById('pid').value = id;
        document.getElementById('puformat').value = f;
        document.getElementById('puprice').value = p;
        $("#pupdateModal").modal('show')
    }
    function SelectInventory(id)
    {
        document.getElementById('noid').value = id;
       document.forms["noform"].submit();
    }
     
     function Mnewformat()
    {
        $("#MnewModal").modal('show')
    } 
    
    function  Reload()
    {	
    document.forms["mainform"].submit();
    return;
    }
</script>



  
@stop
