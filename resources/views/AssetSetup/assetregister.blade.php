@extends('layouts.layout')
@section('pageTitle')
    Asset Register
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Asset Register</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Asset Register</a></li>
         
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
	        
                <form method="post" name="mainform" id="mainform">
                        <input type="hidden" class="form-control"  name="dptype" value="{{$AssetCategoryPara->depreciation_type}}">
                {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                   <select  class="form-control" name="category"   onchange="Reload()">
                                        <option value="">--Select--</option>
                                          @foreach($AssetCategory as $list)
                                        <option value="{{ $list->id }}" {{ (old('category') == $list->id ||($category) == $list->id  ) ? 'selected':'' }}>{{ $list->category }}</option>
                                          @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                   <select  class="form-control" name="type" onchange="Reload()" >
                                     <option value="">--Select--</option>
                                          @foreach($AssetTypeList as $list)
                                     <option value="{{ $list->id }}" {{ (old('type') == $list->id ||($type) == $list->id  ) ? 'selected':'' }}>{{ $list->assettype }}</option>
                                          @endforeach
                                   </select>
                                </div>
                            </div>
                           <!--<div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Asset</label>
                                   <select  class="form-control" name="asset" onchange="Reload()" >
                                <option value="">--Select--</option>
                                  @foreach($AssetList as $list)
                                    <option value="{{ $list->id }}" {{ (old('asset') == $list->id ||($asset) == $list->id  ) ? 'selected':'' }}>{{ $list->asset_description }}</option>
                                  @endforeach
                                </select>
                                </div>
                            </div>
                            -->
                        </div>
                        <div class="table-responsive" style="font-size: 12px;">
                            <table class="table table-bordered table-striped table-highlight" >
                		  	<tr>
                				<th >Category</th> <th >Type</th><th >Asset Description</th><th >Label Code</th> <th >Purchase date</th><th>Value at Puchase</th><th>Last Valued</th><th>Current Value</th><th>Scrapped Target</th><th>Lifespan(Months)</th>
                	 		</tr>
                			
                			
                			 @foreach($AssetEntityList as $data)
                			@php
                			
                			@endphp
                					<tr>
                					<td>{{$data->cat}} </td>
                					<td>{{$data->typ}}</td>
                					<td>{{$data->asset}}</td>
                					<td>{{$data->uniquecode}}</td>
                					<td>{{date("jS M, Y", strtotime($data->purchase_date))}}</td>
                					<td>{{number_format($data->value_at_purchase,2, '.', ',')}}</td>
                					<td>{{date("Y-m-d", strtotime($data->last_valued))}}</td>
                					<td>{{number_format($data->current_value,2, '.', ',')}}</td>
                					<td>{{number_format($data->scrap_value,2, '.', ',')}}</td>
                					<td>{{$data->valid_period}}</td>
                					
                					</tr>
                			@endforeach
                			<tr>
                					<td colspan=10></td>
                					
                			</tr>
				        </table>
                        </div>
                    </div>
                </form>
                <!--===================================================-->
                <!-- End Inline Form  -->
            </div>
        </div>
    
    <!--modal for deleting record-->
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

    function editfunc(id,manu,brand)
    {
        document.getElementById('id').value = id;
        document.getElementById('manu').value = manu;
        document.getElementById('brand').value = brand;
        
        $("#editModal").modal('show')
    }
   function deletefunc(id)
    {
        document.getElementById('deleteid').value = id;
                     
        $("#deleteModal").modal('show')
    }
    
    function fetchMain()
    {
      var txv=document.getElementById('refaccountid').value;
    	var tx = txv.split(':');
    	var id=tx[0];
        //var id = document.getElementById('refaccountid').value;
         
        document.getElementById('acctid').value= id; 
        
        document.getElementById('refaccountname').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
    }
    function fetchMains()
    {
        var txv=document.getElementById('refaccountids').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctids').value= id; 
        document.getElementById("refaccountids").style.display="none";
        document.getElementById('refaccountnames').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMains()
    {
        
        document.getElementById('acctids').value= '';
        document.getElementById('refaccountids').value= '';
        document.getElementById("refaccountids").style.display="block";
        document.getElementById('refaccountnames').value='';
       
    }
    function  Reload()
        {	
        document.forms["mainform"].submit();
        return;
        }
             
</script>



  
@stop
