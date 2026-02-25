@extends('layouts.layout')
@section('pageTitle')
    Account Statement
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Report</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Account Statement</a></li>
         
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
                                    <label class="control-label">Reference Account:</label>
                                    <input type="hidden"  id="acctid" name="acctid"  value="{{$acctid}}">
                                    <input type="text" list="refaccount" name="refaccount" id="refaccountid"  class="form-control" autocomplete="off"  placeholder="Select Account" onchange="fetchMain()">
                                    <datalist id="refaccount">
                                        @foreach($AccountList as $list)
                                        <option value="{{ $list->id }}:{{ $list->accountdescription }}({{ $list->accountno}})">{{ $list->accountdescription }}({{ $list->accountno}})</option>
                                        @endforeach
                        			</datalist>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Account Name:</label> 
                                    <input type="text"  value="{{$accountname}}" class="form-control" id="refaccountname" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">From:</label>
                                    <input type="date" name="fromdate" value="{{$fromdate}}"   class="form-control" style="width:150px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label >To:</label> 
                                    <input type="date" name="todate" value="{{$todate}}"   class="form-control" style="width:150px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label ><br></label>
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="post">Go</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="font-size: 12px;" id="tableData">
                            <table class="table table-bordered table-striped table-highlight" ><thead>
                		  	<tr bgcolor="#c7c7c7">
                				<th >Transaction Date</th> <!--<th >Prev Balance</th>--><th >Debit</th> <th >credit</th> <th>Balance</th><th>Ref No</th><th>Auto-Ref No</th><th>Remarks</th>
                			</tr>
                			</thead>
                			
                				@foreach($AccountStatementRunningTotal as $data)
                				<tr>
                        		<td>{{  $data->transdate}}</td>
                        		<!--<td style="text-align: right; "> @if( $data->prev<0)({{  number_format(abs($data->prev),2, '.', ',')}})  @else{{  number_format(abs($data->prev),2, '.', ',')}} @endif</td>-->
                        		<td style="text-align: right; ">{{number_format(abs($data->debit),2, '.', ',') }}</td>
                        		<td style="text-align: right; ">{{  number_format(abs($data->credit),2, '.', ',')}} </td>
                        		<td style="text-align: right; ">@if( $data->current<0)({{  number_format(abs($data->current),2, '.', ',')}})  @else{{  number_format(abs($data->current),2, '.', ',')}} @endif</td>
                        		<td>{{  $data->manual_ref}} </td>
                        		<td> &nbsp;{{  $data->ref}} </td>
                        		<td>{{  $data->remarks}}</td>
                        		
                        			
		                        </tr>	
                				@endforeach
                				
                	 		
                			
				        </table>
                        </div>
                    </div>
                </form>
                <input type="button" class="hidden-print" id="btnExport" value="Export to Excel" onclick="Export()" /> 
                <input type="button" class="hidden-print" id="btnExport" value="Download PDF" onclick="ExportPDF()" /> 
                <!--===================================================-->
                <!-- End Inline Form  -->
            </div>
        </div>
    </div>
</div>
<form method="post" target="_blank"  action="/account-statement-pdf" id ="pdf" name="pdf">
    {{ csrf_field() }}
    <input type="hidden" name="acctid"  value="{{$acctid}}">
    <input type="hidden" name="fromdate"  value="{{$fromdate}}">
    <input type="hidden" name="todate"  value="{{$todate}}">
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
<script src="/assets/js/table2excel.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
function  ExportPDF(){	document.forms["pdf"].submit();}  

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
    function Export() {
            $("#tableData").table2excel({
                filename: "ledger_transaction.xls"
            });
        }
             
</script>



  
@stop
