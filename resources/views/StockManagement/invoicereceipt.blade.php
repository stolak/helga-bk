@extends('layouts.layout')
@section('pageTitle')
    Invoice Receipt
@endsection
@section('content')
    <div class="boxed">
        <div id="page-content">
        <div class="panel">
            <div class="panel-body">
              @include('_partialView.nofication')
              
              <form name ="mainform" id ="mainform" method="POST"  class="form-horizontal">
<div class="container-fluid invoice-container" id="ppp" style = "font-size:7px">
    <div style="font-size:8px;margin:5px;">
    <table class="table table-condensed">
         <tr>
            <th colspan=2>
                <div class="text-center">
    			<p><img src="/img/coatofarm" style="width:120px;height:45px;"/></p>
    			<h4>{{env('Coy_Name', '')}}</h4>
    			<h6>{{env('Coy_Address', '')}} </h6>
    			<p style = "font-size:8px">{{env('Coy_email', '')}}, {{env('Coy_phone', '')}}</p>
    			<h4>Sales Receipt</h4>
    			<h5>Invoice No: # {{$InvoiceDetails[0]->invoice_no?? ''}}</h5>
    			</div>
    			</th>
        </tr>
        <tr>
            <th>
			<h4>Invoice To:{{$InvoiceDetails[0]->cusname?? 'NA'}}</h4>
            <th>
			<div class="text-right">
			  
			<h6>Customer Address</h6>
			
			<h6>{{$customerInfo->email?? ''}} {{$customerInfo->phoneno?? ''}}</h6>
			<h6>Date:{{date("d-m-Y", strtotime($InvoiceDetails[0]->postedat?? ''))}}</h6>  
			
			</div>
			</th>
        </tr>
    </table>

<div class="panel panel-default">
<div class="panel-heading">
     <h3 class=""><strong><center>Invoice @if($InvoiceDetails[0]->cus_sup_id==0) {{($InvoiceDetails[0]->is_closed==1)? "#Paid": "#Unpaid invoice" }} @endif </center></strong></h3>
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td><strong>#</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Cost/per format</strong></td>
                    <td><strong>Quantity</strong></td>
                    <td><strong>Subtotal</strong></td>
                     <td><strong>Discount</strong></td>
                    <td><strong>Total Value</strong></td>
                </tr>
            </thead>
            <tbody>
                @php
                $sn=1;
            	$totaldisc=0;
            	$totalfinal=0;
            	$total=0 ;
            	@endphp
            	@foreach($InvoiceDetails as $list)
            		<tr>
            		<td>{{$sn++}} </td>
            		<td>{{$list->item}} </td>
            		<td>{{number_format($list->formatprice,2, '.', ',')}}/{{$list->format}}</td>
            		<td>{{$list->skuqty/$list->formatqty}}</td>
            		<td>{{number_format($list->subtotal,2, '.', ',')}}</td>
            		<td>{{$list->disc_perc}}</td>
            		<td>{{number_format($list->ftotal,2, '.', ',')}}</td>
            		</tr>
            		@php $totalfinal+=$list->ftotal;@endphp
            	@endforeach
            	<tr>
            	    <td colspan=6><strong>Sum Total </strong></td>
            		
            		<td><strong>{{number_format($totalfinal,2, '.', ',')}}</strong></td>
            	</tr>
            </tbody>
        </table>
    </div>
   <div class="row">
        
        <div class="col-sm-6 text-left">
            ---------------------------------------------------<br>
        customer signature<br>
            @if($InvoiceDetails[0]->cus_sup_id!=0)
        <strong>Current Balance: {{number_format($customerInfo->accountbal??0,2)}}</strong>
        @endif
        <br>
        
        </div>
        <div class="col-sm-6">
        
        </div>
    </div> 
<div class="form-group">
    <div class="col-lg-12 text-right">
      <h6>invoiced by: {{$InvoiceDetails[0]->invoicedby?? ""}}</h6>
    </div>
</div>   
</div>
</div>
</div>
</div>

	<br>	
	<button type="button"  onclick='openWindowback()'  class="btn btn-primary">Back <i class="fa fa-arrow-left"></i></button>
	<button type="button"  onclick='printDiv("ppp")'  class="btn btn-primary">Print </button>
	@if((($InvoiceDetails[0]->cus_sup_id?? 0)==0)&& (($InvoiceDetails[0]->is_closed?? 0)==0))
	<button type="button"  onclick='Payment( "{{$InvoiceDetails[0]->refno?? ""}}", "{{$InvoiceDetails[0]->cusname?? "NA"}}","{{number_format($totalfinal,2, '.', ',')}}")'  class="btn btn-primary">Make Payment </button>
@endif
@if((($InvoiceDetails[0]->cus_sup_id?? 0)!=0)&& (($customerInfo->accountbal??0)>0))
    <button type="button"  onclick='Gotopayment()'  class="btn btn-primary">Make Payment </button>
@endif
</form>	
                <!-- Payment Popup-->
                 <div id="paymentModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"> <div id="refid"></div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="row" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="ref-no" name="ref">
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label"><h5>Customer Name: </h5></label>
                            <input type="text" class="form-control" id="cusname"  readonly>
                        </div>
                      </div>
                      
                      
                      <div class="col-sm-4">
			             <div class="form-group">
                          <label class="control-label"><h5>Total due: </h5></label>
                          <input type="text" class="form-control" id="amount" name="amount" readonly>
                        </div>
                      </div>
                      <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><h5>Mode of Payment</h5></label>
                                    <select class="form-control" id="mode" name="mode" >
                                        @foreach($PaymentMode as $list)
                                        <option value="{{ $list->id }}" {{ (old('mode') == $list->id ||($mode) == $list->id  ) ? 'selected':'' }}>{{ $list->mode}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                      <div class="col-sm-12">
			            <div class="form-group">
                          <label class="control-label"><h5>Remarks: </h5></label>
                          <input type="text" class="form-control"  name="remark">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="pay">Pay Now</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
            <!-- //Payment Popup-->
            </div>
        </div>
    
     </div>
      
        </div>
   
<form method="post"  id="noform" name="noform" action="/sales-payment">
{{ csrf_field() }}
 <input type="hidden" class="form-control" id="customer" name="customer" value="{{$InvoiceDetails[0]->cus_sup_id?? 0}}">
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
    function Payment(ref,cusname,amount)
    {
        document.getElementById('ref-no').value = ref;
        document.getElementById('cusname').value = cusname;
        document.getElementById('amount').value = amount;
        document.getElementById('refid').innerHTML = "Payment Ref#:" +ref;
                     
        $("#paymentModal").modal('show')
    }
    
   function  Reload()
        {	
        document.forms["mainform"].submit();
        return;
        }
    function  Gotopayment()
        {	
        document.forms["noform"].submit();
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
  
  
</script>



  
@stop
