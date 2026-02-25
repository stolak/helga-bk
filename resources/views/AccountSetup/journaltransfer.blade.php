@extends('layouts.layout')
@section('pageTitle')
    Journal Transfer
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Transaction</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Journal Transfer</a></li>
         
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
                <form method="post" id="mainform" name="mainform">
                {{ csrf_field() }}
                    <div class="panel-body">
                       
                        <div class="table-responsive" style="font-size: 12px;">
                             <div id="showtable" >
        <table class="table table-bordered table-striped table-highlight"  id="mytable">
		  	<tr>
				<th >TL</th> <th >Account</th><th >Debit </th> <th >Credit</th><th>Remarks</th><th>Action</th>
	 		</tr>
			<tr> 
			<td ><select id="transactiontype" name="transactiontype" style="width:75px;" class="form-control" onchange="TextBoxState()">
				<option value="">-Select-</option>
				@foreach($AccountTransType as $list)
                    <option value="{{ $list->transtype }}"  {{ (old('transactiontype') == $list->transtype ||($transactiontype) == $list->transtype  ) ? 'selected':'' }}>{{ $list->transtype }}</option>
                @endforeach
				</select>
			</td>
			<td ><?php if($acctids=='') $acctids= old('acctids'); ?>
			    <input type="hidden"  id="acctids" name="acctids"  value="{{$acctids}}">
			    <input type="hidden"  id="delid" name="delid" >
			    <input type="hidden"  id="oldlist" name="oldlist" >
			    <input  autocomplete="off" type="text" list="refaccounts" name="refaccounts" id="refaccountids" @if($acctids!='')style="display:none" @endif style="width:200px;"  class="form-control"  placeholder="Select Account" onchange="fetchMains()" autocomplete="off">
                    <datalist id="refaccounts">
                        @foreach($AccountList as $list)
                        <option value="{{ $list->id }}:{{ $list->accountdescription }}({{ $list->accountno}})">{{ $list->accountdescription }}({{ $list->accountno}})</option>
                        @endforeach
        			</datalist>
        		<?php if($accountnames=='') $accountnames= old('accountnames'); ?>	
			    <div class="input-group" id="hiddenid" style="width:200px;"><input type="text" value="{{$accountnames}}" class="form-control" id="refaccountnames" readonly name="accountnames">
    			    <span class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="UnfetchMains()">X</button>
                    </span>
                </div>
			</td>
			<td >   @php 
			        $dbtstatus='';
			        $crdtstatus="";
			        if(old('oldlist')) $datalist= old('oldlist');
			        //dd(old('oldlist'));
			        if($transactiontype=='') $transactiontype= old('transactiontype');
			        
			        if($transactiontype=="Credit") $dbtstatus="disabled";
        			if($transactiontype=="Debit") $crdtstatus="disabled";
			        @endphp
			    <div class="input-group"><span class="input-group-btn">
                <button type="button" class="btn btn-default" >N</button>
                <?php if($debitamount=='') $debitamount= old('debitamount'); ?>
            </span><input disabled type="text" id="debitamount" onblur='ValidateInput("debitamount")' name="debitamount" value="{{$debitamount}}" class="form-control" style="width:150px; text-align: right;" {{$dbtstatus}} autocomplete="off"></div></td>
			<td ><div class="input-group"><span class="input-group-btn">
                <button type="button" class="btn btn-default" >N</button>
                <?php if($creditamount=='') $creditamount= old('creditamount'); ?>
            </span><input disabled type="text" id="creditamount" onblur='ValidateInput("creditamount")' name="creditamount" value="{{$creditamount}}" class="form-control" style="width:150px; text-align: right;" {{$crdtstatus}} autocomplete="off"></div></td>
            <?php if($remarks=='') $remarks= old('remarks'); ?>
             <td><input type="text" id="remarks" name="remarks" value="{{$remarks}}" class="form-control" style="width:250px;" autocomplete="off"></td>
			<td ><button type="button" class="btn btn-primary" name="add" onclick="AddRecord();">Add</button></td>
			</tr>
			 @php
		        $totaldebit =0;
			    $totalcredit =0 ;
			 @endphp
			
				
			
 </table>
        </div>
</div>
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
              <h4 class="modal-title">Edit Entry</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="id" name="id">
                      <div class="row">
                      <div class="col-sm-3">
			             <div class="form-group">
                      <label class="control-label"><h5>Trans Type: </h5></label>
                      <select  class="form-control" id="e-transtype"name="transactiontype" onchange="E_TextBoxState()">
                         <option value="">--Select--</option>
                           @foreach($AccountTransType as $list)
                                <option value="{{ $list->transtype }}"  >{{ $list->transtype }}</option>
                            @endforeach   
                       </select>
                        </div>
                      </div>
                      <div class="col-sm-9">
			             <div class="form-group">
                      <label class="control-label"><h5>Account Ledger: </h5></label>
                      <select  class="form-control" id="e-acctids"name="acctids" >
                         <option value="">--Select--</option>
                           @foreach($AccountList as $list)
                        <option value="{{ $list->id }}">{{ $list->accountdescription }}({{ $list->accountno}})</option>
                        @endforeach   
                       </select>
                        </div>
                      </div>
                      </div>
                      <div class="col-sm-6">
			             <div class="form-group">
                      <label class="control-label"><h5>Debit: </h5></label>
                      <input type="text" class="form-control" id="e-debitamount" name="debitamount">
                        </div>
                      </div>
                      <div class="col-sm-6">
			             <div class="form-group">
                      <label class="control-label"><h5>Credit: </h5></label>
                      <input type="text" class="form-control" id="e-creditamount" name="creditamount">
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Remarks: </h5></label>
                      <input type="text" class="form-control" id="e-remarks" name="remarks">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="UpdateRecord()">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
                    <input type="hidden" class="form-control"  name="validationcode" value="{{$validationcode}}">
                     <input type="hidden" class="form-control" id="datalist" name="datalist" >
                    
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
    <div id="clearModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Reset record</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <div class="col-sm-12">
                        <center><h3 style="color:black;">Do you really want to reset this records</h3></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="clear" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
                </form>
            </div>
            
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
.cellStyle{
     text-align: right;
}
</style>
@stop
@section('scripts')

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
//var table = document.getElementById('mytable').innerHTML;
var tableinnerHTML = document.getElementById('mytable').innerHTML;
var curJornal = [];
var drbal=0;
var crbal=0;
    function editfunc(id,transtype,acctids,debitamount,creditamount,remarks)
    {
        
        document.getElementById('id').value = id;
        document.getElementById('e-transtype').value = transtype;
        if(transtype=="Debit"){
        document.getElementById('e-debitamount').removeAttribute('disabled'); 
        document.getElementById('e-creditamount').setAttribute('disabled', 'disabled');
        }else{
         document.getElementById('e-creditamount').removeAttribute('disabled'); 
        document.getElementById('e-debitamount').setAttribute('disabled', 'disabled');  
        }
        document.getElementById('e-acctids').value = acctids;
        document.getElementById('e-debitamount').value = debitamount;
        document.getElementById('e-creditamount').value = creditamount;
        document.getElementById('e-remarks').value = remarks;
        
        $("#editModal").modal('show')
    }
   function deletefunc(id)
    {
        document.getElementById('delid').value = id;
        document.forms["mainform"].submit();
	   return;            
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
    function  E_TextBoxState()
    {	
    var Val=document.getElementById("e-transtype").value;
    
      if(Val=="Debit"){
        document.getElementById('e-debitamount').value="";
        document.getElementById('e-creditamount').value="";
        document.getElementById('e-debitamount').removeAttribute('disabled'); 
        document.getElementById('e-creditamount').setAttribute('disabled', 'disabled');
      }
      if(Val=="Credit"){
        document.getElementById('e-creditamount').removeAttribute('disabled'); 
        document.getElementById('e-debitamount').setAttribute('disabled', 'disabled');
        document.getElementById('e-debitamount').value="";
        document.getElementById('e-creditamount').value="";
      }
      
    return;
    }
    function  TextBoxState()
    {	
    var Val=document.getElementById("transactiontype").value;
    
       if(Val=="Debit"){
        document.getElementById('debitamount').value=drbal;
        document.getElementById('creditamount').value="";
        document.getElementById('debitamount').removeAttribute('disabled'); 
        document.getElementById('creditamount').setAttribute('disabled', 'disabled');
      }
      if(Val=="Credit"){
        document.getElementById('creditamount').removeAttribute('disabled'); 
        document.getElementById('debitamount').setAttribute('disabled', 'disabled');
        document.getElementById('debitamount').value="";
        document.getElementById('creditamount').value=crbal;
      }
      //document.getElementById('remarks').value="{{$defaultremark}}"
    return;
    }
    
    function AddRecord()
    {
        if((Number(document.getElementById('debitamount').value)<=0) && (Number(document.getElementById('creditamount').value)<=0)) return false;
        if(!document.getElementById("acctids").value) return false;
        if(!document.getElementById("remarks").value) return false;
        var json_arr = {};
        json_arr["countid"] = curJornal.length+1;
        json_arr["transactiontype"] = document.getElementById('transactiontype').value;
        json_arr["acctids"] = document.getElementById("acctids").value;
        json_arr["refaccountnames"] = document.getElementById('refaccountnames').value;
        json_arr["debitamount"] = document.getElementById('debitamount').value.replace(/\,/g,'');
        json_arr["creditamount"] = document.getElementById('creditamount').value.replace(/\,/g,'');
        json_arr["remarks"] = document.getElementById('remarks').value;
        curJornal.push(json_arr);
        createTransaction();
    }
    
    function UpdateRecord()
    {
        
        if((Number(document.getElementById('e-debitamount').value)<=0) && (Number(document.getElementById('e-creditamount').value)<=0)) return false;
        if(!document.getElementById("e-acctids").value) return false;
        if(!document.getElementById("e-remarks").value) return false;
        var id=document.getElementById('id').value;
        for (i = 0; i < curJornal.length; i++) {
            
            if(curJornal[i].countid==id){
        
            curJornal[i].transactiontype = document.getElementById('e-transtype').value;
            curJornal[i].acctids = document.getElementById("e-acctids").value;
            curJornal[i].refaccountnames  = document.getElementById('desc'+curJornal[i].acctids).value +" "+ document.getElementById('acct'+curJornal[i].acctids).value;
            curJornal[i].debitamount  = document.getElementById('e-debitamount').value.replace(/\,/g,'');
            curJornal[i].creditamount  = document.getElementById('e-creditamount').value.replace(/\,/g,'');
            curJornal[i].remarks  = document.getElementById('e-remarks').value;
            }
        }
        createTransaction();
         $("#editModal").modal('hide')
    }
    function RemoveRecord(id)
    {
        var tempRecords = [];
        for (i = 0; i < curJornal.length; i++) {
            if(curJornal[i].countid!=id){
                curJornal[i].countid=tempRecords.length+1
                tempRecords.push(curJornal[i]);
            }
        }
        curJornal=tempRecords;
        createTransaction();
    }
      function createTransaction(){
    var table = document.createElement("table");
    table.innerHTML=tableinnerHTML;
    var remarks='';
    var debit=0;
    var credit=0;
    for (i = 0; i < curJornal.length; i++) {
       //alert("hdhdhdh");
     tr = table.insertRow(-1);
            obj = curJornal[i]
           
            var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = obj.transactiontype;
            var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = obj.refaccountnames;
            var tabCell = tr.insertCell(-1);
            var a=parseFloat(obj.debitamount.replace(/\,/g,'')).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                tabCell.innerHTML = (a=="NaN") ?0:a;
                tabCell.className = 'cellStyle';
            var tabCell = tr.insertCell(-1);
            var b=parseFloat(obj.creditamount.replace(/\,/g,'')).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                tabCell.innerHTML = (b=="NaN") ?0:b;;
                tabCell.className = 'cellStyle';
              tr.insertCell(-1).innerHTML=obj.remarks;
              remarks=obj.remarks;
               tr.insertCell(-1).innerHTML= '<a onclick="RemoveRecord('+obj.countid+ ')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a> <a onclick="editfunc('+'&apos;' +obj.countid +'&apos;'+ ',&apos;' +obj.transactiontype + '&apos;,&apos;' + obj.acctids + '&apos;,&apos;' + obj.debitamount+ '&apos;,&apos;'+obj.creditamount+ '&apos;,&apos;'+obj.remarks+ '&apos;)" class="btn btn-success glyphicon glyphicon-pencil btn-xs"></a>' ;
           var dr = parseFloat(obj.debitamount.replace(/\,/g,'')).toFixed(2);
           dr= (dr=="NaN")?0:dr;
           var cr =parseFloat(obj.creditamount.replace(/\,/g,'')).toFixed(2)
           cr= (cr=="NaN") ?0:cr;
           debit += parseFloat(dr);
           credit +=parseFloat(cr)
        
    }
    
    if(curJornal.length>0){
        tr = table.insertRow(-1);
        tr.insertCell(-1).innerHTML='';
        tr.insertCell(-1).innerHTML='';
        var tabCell= tr.insertCell(-1);
        tabCell.className = 'cellStyle';
        tabCell.innerHTML=debit.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
      
        var tabCell= tr.insertCell(-1);
        tabCell.className = 'cellStyle';
        crbal=0;
        drbal=0;
        if(credit>debit){
            drbal=credit-debit;
        }
        if(credit<debit){
            crbal=debit-credit;
        }
      tabCell.innerHTML=credit.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
      tr.insertCell(-1).innerHTML='';
      if(credit==debit){
        tr.insertCell(-1).innerHTML= '<a class="btn btn-primary" onclick="PostSJournal()">Post</a> <a class="btn btn-danger btn-sm" onclick="clearAll()">Reset</a>'; 
      }else{
        tr.insertCell(-1).innerHTML='<button type="button" class="btn btn-danger" name="post" onclick="clearAll()">Reset</button>';
      }
     }
    // alert("jdjdjdj");
    var divContainer = document.getElementById("showtable");
        divContainer.innerHTML = "";
        table.className += "table table-bordered table-striped table-highlight table-responsive";
        divContainer.appendChild(table); 
        document.getElementById('oldlist').value = JSON.stringify(curJornal);
        // document.getElementById("qty").value=0;
         document.getElementById("transactiontype").focus();
        // document.getElementById("stockid").select();
        document.getElementById('remarks').value=remarks
    } 
    
    function ValidateInput(id){
        var a=parseFloat(document.getElementById(id).value.toString().replace(/\,/g,'')).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById(id).value = (a=="NaN") ?0:a;
    
   }
   function PostSJournal()
    {
        document.getElementById('datalist').value = JSON.stringify(curJornal);
        $("#postModal").modal('show')
    }
    function clearAll()
    {
        
        $("#clearModal").modal('show')
    }
    $( document ).ready(function() {
        @if($datalist)
    @foreach (json_decode($datalist) as $bb)
    var json_arr = {};
        json_arr["countid"] = "{{$bb->countid}}";
        json_arr["transactiontype"] = "{{$bb->transactiontype}}";
        json_arr["acctids"] = "{{$bb->acctids}}";
        json_arr["refaccountnames"] = "{{$bb->refaccountnames}}" ;
        json_arr["debitamount"] = "{{$bb->debitamount}}";
        json_arr["creditamount"] = "{{$bb->creditamount}}";
        json_arr["remarks"] = "{{$bb->remarks}}";
        curJornal.push(json_arr);
    @endforeach
    createTransaction();
        @endif
});
</script>
@stop
