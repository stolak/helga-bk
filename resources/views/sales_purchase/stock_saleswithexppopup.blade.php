@extends('layouts.layout')
@section('pageTitle')
    Stock Sales
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Sales</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Stock Sales</a></li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="boxed">
        <div id="page-content">
        <div class="panel">
            <div class="panel-body">
              @include('_partialView.nofication')
              <input type="hidden" id="sp"  value="0">
	            @foreach($SalesFormat as $list)
                <input type="hidden" id="sp{{$list->id}}"  value="{{$list->price}}">
                @endforeach
                <form method="post" id="mainform" name="mainform">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Customer Names</label>
                                        <select class="select_picker_customer form-control" id="customer" data-live-search="true" name="customer" onchange="Reload();">
                                        <option value="">--Select--</option>
                                        @foreach($Customers as $list)
                                        <option value="{{ $list->id }}" {{ (old('customer') == $list->id ||($customer) == $list->id  ) ? 'selected':'' }}>{{ $list->firstname }}{{ $list->middlename }} {{ $list->surname }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Transaction date</label>
                                    <input type="date" name="transdate" value="{{$transdate}}"   class="form-control" style="width:150px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Stock</th>
		            <th>Sales Format</th>
		            <th>Selling Price</th>
		            <th>QTY</th>
		            <th>Sub Total</th>
		            <th>Disc %</th>
		            <th>Gross</th>
		            <th>Exp date</th>
		            <th>Action</th>
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          $id='id';
		          $grosstotal=0;
		          @endphp
		           
		            
		                           
		               <tr>
		               <td> </td>
		               <td> <div class="form-group" style="width:300px;">
                                <select class="select_picker_stockid form-control" id="stockid" data-live-search="true" name="stockid" onchange="Reload();" >
                                    <option value="">--Select--</option>
                                    @foreach($InventoryList as $list)
                                    <option value="{{ $list->id }}" {{ (old('stockid') == $list->id ||($stockid) == $list->id  ) ? 'selected':'' }}>{{ $list->item_description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
		               <td> <select id="sformat" name="sformat" style="width:150px;" class="form-control" onchange="DoAfterFormat()">
                				<option value="">-Select-</option>
                				    @foreach($SalesFormat as $list)
                                    <option value="{{ $list->id }}" {{ (old('sformat') == $list->id ||($sformat) == $list->id  ) ? 'selected':'' }}>{{ $list->format }}</option>
                                    @endforeach
                				</select>
                		</td>
                		<td><input type="text" class="form-control"  id="spr" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
                		<td><input type="number" class="form-control" id="qty"name="qty" value=""   style="width:70px; " onkeyup='DoAfterFormat()'></td>
                		<td><input type="text" class="form-control" id="subt" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
		               <td><input type="text" class="form-control"  id="disc" value="0"   style="text-align: right;width:50px; " readonly></td>
		               <td><input type="text" class="form-control"  id="gross" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
		               <td><input type="text" class="form-control"  id="exp-id" name="expdate "value=""  readonly style="text-align: right;width:100px; "></td>
		               <td>
		               <button type="submit" class="btn btn-primary" name="add">Add</button>
		               </td>
		              
		               </tr>
		               @foreach($InventoryRecords as $list)
    		           <tr>
    		               <td>{{$i++}} </td>
    		               <td>{{$list->item}} </td>
    		               <td>{{$list->format}} </td>
    		               <td style="text-align:right">{{number_format($list->formatprice,2, '.', ',')}} </td>
    		               <td>{{$list->skuqty/$list->formatqty}} </td>
    		               <td style="text-align:right">{{number_format($list->subtotal,2, '.', ',')}} </td>
    		               <td> {{$list->disc_perc}} </td>
    		               <td style="text-align:right">{{number_format($list->ftotal,2, '.', ',')}} </td>
    		               <td style="text-align:right">{{$list->expdate}} </td>
    		               @php $grosstotal +=$list->ftotal; @endphp
    		               <td> <a onclick="deletefunc('{{$list->id}}','{{$list->item}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a></td>
    		            </tr>
    		            @endforeach
		                <tr>
		                    <td colspan =7> Total </td>
		                    <td style="text-align:right">{{number_format($grosstotal,2, '.', ',')}} </td>
		                     <td>  </td>
		                    <td><button type="submit" class="btn btn-primary" name="post">Post</button> </td>
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
      @include('_partialView.sale_stock_bal_pop')
      <div id="deleteModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Inventory Item</h4>
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
                        <center><h1 style="color:black;">Are you sure <div id="content5"></div>?</h1></center>
                        
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

    $('.select_picker_customer').selectpicker({
          style: 'btn-default',
          size: 4
        });
        
    $('.select_picker_stockid').selectpicker({
      style: 'btn-default',
      size: 4
    });
     $("#expModal").modal('show')
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
