@extends('layouts.layout')
@section('pageTitle')
    Sales Report
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Report</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Sales Report</a></li>
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
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Processed by</label>
                                    <select class="select_picker_customer form-control" id="customer" data-live-search="true" name="customer" onchange="Reload();">
                                        <option value="">--Select--</option>
                                        @foreach($Customers as $list)
                                        <option value="{{ $list->userid }}" {{ (old('customer') == $list->userid ||($customer) == $list->userid  ) ? 'selected':'' }}>{{ $list->firstname }}{{ $list->middlename }} {{ $list->surname }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">From</label>
                                    <input type="date" name="fromdate" value="{{$fromdate}}"   class="form-control" style="width:150px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">To</label>
                                    <input type="date" name="todate" value="{{$todate}}"   class="form-control" style="width:150px;">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group text-left">
                                    <label class="control-label"><br></label><br>
                                    <button type="submit" class="btn btn-primary" name="post">Go</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>Transaction Date</th>
		            <th>Invoice to</th>
		            <th>Amount</th>
		            <th>Reference</th>
		            <th></th>
		            
		          </tr>
		        </thead>
		               
		        <tbody>
		               @php $total=0;@endphp
		               @foreach($SalesReports as $list)
    		           <tr>
    		               <td>{{$list->postedat}} </td>
    		               <td>{{$list->cusname}} </td>
    		               <td>{{number_format($list->t_sales,2, '.', ',')}} </td>
    		               <td>{{$list->refno}} </td>
    		               <td> <a href="/invoice-receipt/{{$list->refno}}" class="btn btn-success">View</a></td>
    		            </tr>
    		             @php $total+=$list->t_sales;@endphp
    		            @endforeach
		                  <tr>
    		               <td colspan =2><b>Total</b> </td>
    		               
    		               <td><b>{{number_format($total,2, '.', ',')}}</b> </td>
    		              <td> </td>
    		               <td></td>
    		            </tr>
		           
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
  
  
</script>



  
@stop
