@extends('layouts.layout')
@section('pageTitle')
    Asset Category
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Asset Setup</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Asset Category</a></li>
         
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
@endsection
@section('content')

    <!--- content comes here -->

    @extends('layouts.layout')
@section('pageTitle')
    Asset Category
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Asset Setup</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Asset Category</a></li>
         
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
	        
	            @foreach($AccountList as $list)
                <input type="hidden" id="id{{$list->id}}"  value="{{$list->id}}">
                <input type="hidden" id="acct{{$list->id}}"  value="({{$list->accountno}})">
                <input type="hidden" id="desc{{$list->id}}"  value="{{$list->accountdescription}}">
                @endforeach
                <form method="post">
                {{ csrf_field() }}
                    <div class="panel-body">
                         <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Depreciation class</label>
                                    <select  class="form-control" name="dtype" >
                                     <option value="">--Select--</option>
                                          @foreach($DepreciationType as $list)
                                     <option value="{{ $list->id }}" {{ (old('dtype') == $list->id ||($dtype) == $list->id  ) ? 'selected':'' }}>{{ $list->d_type }}</option>
                                          @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Asset Category</label>
                                    <?php if($category=='') $brand= old('category'); ?>
                                    <input type="text" class="form-control"  value="{{$category}}" required name="category"  autocomplete="off">
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Asset Account:</label>
                                    <?php if($acctid1=='') $acctids= old('acctid1'); ?>
                    			    <input type="hidden"  id="acctid1" name="acctid1"  value="{{$acctid1}}">
                    			    <input type="text" list="refaccount1" name="refaccount1" id="refaccountid1" @if($acctid1!='')style="display:none" @endif   class="form-control"  placeholder="Select Account" onchange="fetchMain1()" autocomplete="off">
                                        <datalist id="refaccount1">
                                            @foreach($AccountList as $list)
                                            <option value="{{ $list->id }}:{{ $list->accountdescription }}({{ $list->accountno}})">{{ $list->accountdescription }}({{ $list->accountno}})</option>
                                            @endforeach
                            			</datalist>
                            		<?php if($accountname1=='') $accountname1= old('accountname1'); ?>	
                    			    <div class="input-group" id="hiddenid1"><input type="text" value="{{$accountname1}}" class="form-control" id="refaccountname1" readonly name="accountname1">
                        			    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" onclick="UnfetchMain1()">X</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Accumulated Depreciation Account:</label>
                                    <?php if($acctid3=='') $acctid3= old('acctid3'); ?>
                    			    <input type="hidden"  id="acctid3" name="acctid3"  value="{{$acctid3}}">
                    			    <input type="text" list="refaccount3" name="refaccount3" id="refaccountid3" @if($acctid3!='')style="display:none" @endif   class="form-control"  placeholder="Select Account" onchange="fetchMain3()" autocomplete="off">
                                        <datalist id="refaccount3">
                                            @foreach($AccountList as $list)
                                            <option value="{{ $list->id }}:{{ $list->accountdescription }}({{ $list->accountno}})">{{ $list->accountdescription }}({{ $list->accountno}})</option>
                                            @endforeach
                            			</datalist>
                            		<?php if($accountname3=='') $accountname3= old('accountname3'); ?>	
                    			    <div class="input-group" id="hiddenid3" ><input type="text" value="{{$accountname3}}" class="form-control" id="refaccountname3" readonly name="accountname3">
                        			    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" onclick="UnfetchMain3()">X</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Expense/depreciation Account:</label>
                                    <?php if($acctid2=='') $acctid2= old('acctid2'); ?>
                    			    <input type="hidden"  id="acctid2" name="acctid2"  value="{{$acctid2}}">
                    			    <input type="text" list="refaccount2" name="refaccount2" id="refaccountid2" @if($acctid2!='')style="display:none" @endif   class="form-control"  placeholder="Select Account" onchange="fetchMain2()" autocomplete="off">
                                        <datalist id="refaccount2">
                                            @foreach($AccountList as $list)
                                            <option value="{{ $list->id }}:{{ $list->accountdescription }}({{ $list->accountno}})">{{ $list->accountdescription }}({{ $list->accountno}})</option>
                                            @endforeach
                            			</datalist>
                            		<?php if($accountname2=='') $accountname2= old('accountname2'); ?>	
                    			    <div class="input-group" id="hiddenid2" ><input type="text" value="{{$accountname2}}" class="form-control" id="refaccountname2" readonly name="accountname2">
                        			    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" onclick="UnfetchMain2()">X</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                     
                        </div>
                        <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="addnew">Create</button>
                        </div> 
                        <div class="table-responsive" style="font-size: 12px;">
                            <table class="table table-bordered table-striped table-highlight" ><thead>
                		  	<tr bgcolor="#c7c7c7">
                				<!--<th >Category Code</th>--> <th >Depreciation Class</th><th >Asset Account </th> <th>Accumumulated Account</th><th >Depreciation Account</th> <th>Depreciation Type</th><th>Action</th>
                			</tr>
                			</thead>
                			
                				@foreach($AssetCategory as $data)
                				<tr>
                        		
                        	    <!--<td>{{  $data->cat_code}}</td>-->
                        		<td>{{  $data->category}}</td>
                        		<td>{{  $data->AAcct1}} </td>
                        		<td>{{  $data->AAcct3}}</td>
                        		<td>{{  $data->AAcct2}} </td>
                        		<td>{{  $data->type}}</td>
                        		<td><a href="javascript: deletefunc('{{$data->id}}')"><i class="fa fa-minus-square" style="color:red"></i></a></td>
                        			
		                        </tr>	
                				@endforeach
                				
                	 		
                			
				        </table>
                        </div>
                    </div>
                </form>
                <!--===================================================-->
                <!-- End Inline Form  -->
            </div>
        </div>
    </div>
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
    function fetchMain1()
    {
        var txv=document.getElementById('refaccountid1').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctid1').value= id; 
        document.getElementById("refaccountid1").style.display="none";
        document.getElementById('refaccountname1').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMain1()
    {
        
        document.getElementById('acctid1').value= '';
        document.getElementById('refaccountid1').value= '';
        document.getElementById("refaccountid1").style.display="block";
        document.getElementById('refaccountname1').value='';
       
    }
    function fetchMain2()
    {
        var txv=document.getElementById('refaccountid2').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctid2').value= id; 
        document.getElementById("refaccountid2").style.display="none";
        document.getElementById('refaccountname2').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMain2()
    {
        
        document.getElementById('acctid2').value= '';
        document.getElementById('refaccountid2').value= '';
        document.getElementById("refaccountid2").style.display="block";
        document.getElementById('refaccountname2').value='';
       
    }
    function fetchMain3()
    {
        var txv=document.getElementById('refaccountid3').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctid3').value= id; 
        document.getElementById("refaccountid3").style.display="none";
        document.getElementById('refaccountname3').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMain3()
    {
        
        document.getElementById('acctid3').value= '';
        document.getElementById('refaccountid3').value= '';
        document.getElementById("refaccountid3").style.display="block";
        document.getElementById('refaccountname3').value='';
       
    }
    
             
</script>



  
@stop

  

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
    function fetchMain1()
    {
        var txv=document.getElementById('refaccountid1').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctid1').value= id; 
        document.getElementById("refaccountid1").style.display="none";
        document.getElementById('refaccountname1').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMain1()
    {
        
        document.getElementById('acctid1').value= '';
        document.getElementById('refaccountid1').value= '';
        document.getElementById("refaccountid1").style.display="block";
        document.getElementById('refaccountname1').value='';
       
    }
    function fetchMain2()
    {
        var txv=document.getElementById('refaccountid2').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctid2').value= id; 
        document.getElementById("refaccountid2").style.display="none";
        document.getElementById('refaccountname2').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMain2()
    {
        
        document.getElementById('acctid2').value= '';
        document.getElementById('refaccountid2').value= '';
        document.getElementById("refaccountid2").style.display="block";
        document.getElementById('refaccountname2').value='';
       
    }
    function fetchMain3()
    {
        var txv=document.getElementById('refaccountid3').value;
    	var tx = txv.split(':');
    	var id=tx[0];
    	//alert(id);
        //var id = document.getElementById('refaccountids').value;
        document.getElementById('acctid3').value= id; 
        document.getElementById("refaccountid3").style.display="none";
        document.getElementById('refaccountname3').value=document.getElementById('desc'+id).value +" "+ document.getElementById('acct'+id).value;
       // document.getElementById("hiddenid").style.display="block";
    }
    function UnfetchMain3()
    {
        
        document.getElementById('acctid3').value= '';
        document.getElementById('refaccountid3').value= '';
        document.getElementById("refaccountid3").style.display="block";
        document.getElementById('refaccountname3').value='';
       
    }
    
             
</script>



  
@stop
