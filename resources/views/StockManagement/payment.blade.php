@extends('layouts.layout')
@section('pageTitle')
    Stock Balance
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Payment</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Payment Collection</a></li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="boxed">
        <div id="page-content">
        <div class="panel">
            <div class="panel-body">
              @include('_partialView.nofication')
              
                <form method="post" id="mainform" name="mainform">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Sales Rep/Customer</label>
                                    <select class="select_picker_customer form-control" id="customer" data-live-search="true" name="customer" onchange="Reload();">
                                        <option value="">--Select--</option>
                                        @foreach($Customers as $list)
                                        <option value="{{ $list->id }}" {{ (old('customer') == $list->id ||($customer) == $list->id  ) ? 'selected':'' }}>{{ $list->firstname }}{{ $list->middlename }} {{ $list->surname }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Current Balance</label>
                                    <input type="text"  value="{{number_format($balance,2)??0}}"   class="form-control" style="width:150px;" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Amount</label>
                                    <input type="text" name="amount" value="{{number_format($amount==''? $balance:$amount,2)?? 0}}"   class="form-control" style="width:150px;" id="amount" onblur='ValidateInput("amount")'>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Mode of Payment</label>
                                    <select class="form-control" id="mode" name="mode" >
                                        @foreach($PaymentMode as $list)
                                        <option value="{{ $list->id }}" {{ (old('mode') == $list->id ||($mode) == $list->id  ) ? 'selected':'' }}>{{ $list->mode}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row">

                            
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label class="control-label">Remark</label>
                                    <input type="text" value="{{$remarks}}"   class="form-control"  name="remarks">
                                </div>
                            </div>
                           
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><br></label>
                                    <button type="submit" class="btn btn-primary" name="post">Pay now</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">From:</label>
                                    <input type="date" name="fromdate" value="{{$fromdate}}"   class="form-control" >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label >To:</label> 
                                    <input type="date" name="todate" value="{{$todate}}"   class="form-control" >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label ><br></label>
                                    <br>
                                    <button type="submit" class="btn btn-success" name="update" style="align:left">search</button>
                                </div>
                            </div>
                            </div>
                <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>Date</th>
		            <th>Customer</th>
		            <th>Amount</th>
		            <th>Payment Mode</th>
		            <th>Remark</th>
		            <th>Ref</th>
		            <th>Receive by</th>
		          </tr>
		        </thead>
		               
		        <tbody>
		               
		               @foreach($PaymentReport as $list)
    		           <tr>
    		               <td>{{$list->transdate}} </td>
    		               <td>{{($list->customer_name)?$list->customer_name :'N/A'}} </td>
    		               <td style="text-align:right">{{number_format($list->amount,2, '.', ',')}} </td>
    		               <td>{{$list->pmode}} </td>
    		               <td>{{$list->remarks}} </td>
    		               <td>{{$list->ref}} </td>
    		               <td>{{$list->puser}} </td>
    		            </tr>
    		            @endforeach
		                  
		           
		            </tbody>
		      </table>
		      <br>
		      <br>
		      <br>
		     </div>
		     </form>
            </div>
        </div>
    
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $('.select_picker_customer').selectpicker({
          style: 'btn-default',
          size: 4
        });
        
    $('.select_picker_stockid').selectpicker({
      style: 'btn-default',
      size: 4
    });
    function editfunc(id,ocode,desc,account)
    {
        document.getElementById('id').value = id;
        document.getElementById('e_o_code').value = ocode;
        document.getElementById('e_description').value = desc;
        document.getElementById('e_account').value = account;
        $("#editModal").modal('show')
    }
   function deletefunc(id,item)
    {
        document.getElementById('deleteid').value = id;
        document.getElementById('content5').innerHTML = item;
                     
        $("#deleteModal").modal('show')
    }
    
   function  Reload()
        {	
        document.forms["mainform"].submit();
        return;
        }
   function DoAfterFormat()
    {
        var id=document.getElementById('sformat').value;
        var sp = parseFloat(document.getElementById('sp'+id).value); 
        var qty=document.getElementById('qty').value;
         if(qty=='') qty=0;
        var disc=document.getElementById('disc').value;
        var subt=sp*qty;
        var gross= subt - (disc*subt)*0.01;
        //alert(gross);
        document.getElementById('spr').value=sp.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        document.getElementById('subt').value=subt.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        document.getElementById('gross').value=gross.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
    }
  
   function ValidateInput(id){
    document.getElementById(id).value = parseFloat(document.getElementById(id).value.toString().replace(/\,/g,'')).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   }
</script>



  
@stop
