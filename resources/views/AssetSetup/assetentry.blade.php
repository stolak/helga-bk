@extends('layouts.layout')
@section('pageTitle')
    New Asset Entry
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Asset Entry</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">New Asset Entry</a></li>
         
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
                                    <label class="control-label">Supplier/Source Account :</label>
                                    <select class="select_picker form-control" id="ref" data-live-search="true" name="supplier" onchange="Reload();">
                                     <option value="">--Select--</option>
                                          @foreach($AccountList as $list)
                                            <option value="{{ $list->id }}" {{ (old('supplier') == $list->id ||($supplier) == $list->id  ) ? 'selected':'' }}>{{ $list->accountno }}:{{ $list->accountdescription }}</option>
                                          @endforeach
                                   </select>
                                  
                                </div>
                            </div>
                            
                            </div>
                        <div class="table-responsive" style="font-size: 12px;">
                            <table class="table table-bordered table-striped table-highlight" >
                		  	<tr>
                				<th >Category</th> <th >Type</th><th >Asset Description</th><th >Label Code</th> <th >Purchase date</th><th>Value at Puchase</th><th>Valued Date</th><th>Current Value</th><th>Scrapped Target</th><th>Lifespan(Months)</th><th>Action</th>
                	 		</tr>
                			<tr> 
                			<td >
                				<select  class="form-control" name="category"  style="width:150px;" onchange="Reload()">
                                     <option value="">--Select--</option>
                                          @foreach($AssetCategory as $list)
                                     <option value="{{ $list->id }}" {{ (old('category') == $list->id ||($category) == $list->id  ) ? 'selected':'' }}>{{ $list->category }}</option>
                                          @endforeach
                                   </select>
                			</td>
                			<td >
                			    <select  class="form-control" name="type" style="width:150px;" onchange="Reload()" >
                                     <option value="">--Select--</option>
                                          @foreach($AssetTypeList as $list)
                                     <option value="{{ $list->id }}" {{ (old('type') == $list->id ||($type) == $list->id  ) ? 'selected':'' }}>{{ $list->assettype }}</option>
                                          @endforeach
                                   </select>
                                
                                    
                			</td>
                			<td><select  class="form-control" name="asset" style="width:150px;" >
                                <option value="">--Select--</option>
                                  @foreach($AssetList as $list)
                                    <option value="{{ $list->id }}" {{ (old('asset') == $list->id ||($asset) == $list->id  ) ? 'selected':'' }}>{{ $list->asset_description }}</option>
                                  @endforeach
                                </select>
                            </td>
                			<td ><?php if($uniquecode=='') $uniquecode= old('uniquecode'); ?>
                			
                            </span><input type="text" id="uniquecode" name="uniquecode" value="{{$uniquecode}}" class="form-control" style="width:150px;" autocomplete="off"></div></td>
                            <td>
                                <?php if($pdate=='') $pdate= old('pdate'); ?>
                                <input type="date" name="pdate" value="{{$pdate}}"   class="form-control" style="width:150px;"></td>

                                <td ><?php if($pamount=='') $pamount= old('pamount'); ?>
                			<div class="input-group"><span class="input-group-btn">
                                <button type="button" class="btn btn-default" >N</button>
                            </span><input type="text" id="pamount" name="pamount" value="{{$pamount}}" class="form-control" style="width:150px;text-align: right;" autocomplete="off"></div></td>
                            <td>
                                <?php if($vdate=='') $vdate= old('vdate'); ?>
                                <input type="date" name="vdate" value="{{$vdate}}"   class="form-control" style="width:150px;"></td>

                                <td ><?php if($vamount=='') $vamount= old('vamount'); ?>
                			<div class="input-group"><span class="input-group-btn">
                                <button type="button" class="btn btn-default" >N</button>
                            </span><input type="text" id="vamount" name="vamount" value="{{$vamount}}" class="form-control" style="width:150px; text-align: right;" autocomplete="off"></div>
                            </td>
                            <td >@if($AssetCategoryPara->depreciation_type==2)  <input type="hidden" class="form-control" id="scrapvalue" name="scrapvalue" value="0"> N/A @else<?php if($scrapvalue=='') $scrapvalue= old('scrapvalue'); ?>
                			<div class="input-group"><span class="input-group-btn">
                                <button type="button" class="btn btn-default" >N</button>
                            </span><input type="text" id="scrapvalue" name="scrapvalue" value="{{($scrapvalue=='')?10:$scrapvalue}}" class="form-control" style="width:150px;text-align: right;" autocomplete="off"></div>
                            @endif</td>
                            <td>@if($AssetCategoryPara->depreciation_type==2)  <input type="hidden" class="form-control" id="period" name="period" value="0"> N/A @else
                                <input type="number"  class="form-control"  value="{{$period}}"  name="period" style="width:150px;">
                                @endif
                            </td>
                			<td ><button type="submit" class="btn btn-primary" name="add">Add</button></td>
                			</tr>
                			
                			 @foreach($AssetEntityList as $data)
                			@php
                			
                			@endphp
                					<tr>
                					<td><input type="text" class="form-control"  value="{{$data->cat}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{$data->typ}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{$data->asset}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{$data->uniquecode}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{$data->purchase_date}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{number_format($data->value_at_purchase,2, '.', ',')}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{$data->valued_date}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{number_format($data->current_value,2, '.', ',')}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{number_format($data->scrap_value,2, '.', ',')}}"  readonly></td>
                					<td><input type="text" class="form-control"  value="{{$data->valid_period}}"  readonly></td>
                					<td><a href="javascript: deletefunc('{{$data->id}}')"><i class="fa fa-minus-square" style="color:red"></i></a></td>
                					</tr>
                			@endforeach
                			<tr>
                					<td colspan=10></td>
                					<td><a class="btn btn-primary" onclick="PostSJournal()">Post</a></td>
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
     <div id="postModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Submit record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <div class="col-sm-5">
			            <div class="form-group">
                            <label class="control-label"><h5>JV Ref: </h5></label>
                            <input type="text" class="form-control" id="manual_ref" name="manual_ref" value="{{$manual_ref}}">
                        </div>
                    </div>
                    <div class="col-sm-1">
			            
                    </div>
                    <div class="col-sm-5">
			            <div class="form-group">
                            <label class="control-label"><h5>Transaction date: </h5></label>
                            <input type="date" class="form-control" id="transdate" name="transdate" value="{{$transdate}}">
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-12">
                        <center><h1 style="color:black;">Are you sure <div id="content5"></div>?</h1></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="post" class="btn btn-success">Submit</button>
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
$('.select_picker').selectpicker({
          style: 'btn-default',
          size: 4
        });
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
    function PostSJournal()
    {
        $("#postModal").modal('show')
    }   
</script>



  
@stop
