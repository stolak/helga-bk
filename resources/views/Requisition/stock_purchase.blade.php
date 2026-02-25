@extends('layouts.layout')
@section('pageTitle')
    Stock Purchase
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Purchase Requisition</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Stock</a></li>
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
	            @foreach($PurchaseFormat as $list)
                <input type="hidden" id="sp{{$list->id}}"  value="{{$list->price}}">
                @endforeach
                <form method="post" id="mainform" name="mainform">
                    {{ csrf_field() }}
                     <input type="hidden" id="ref"  name= "ref" value="{{$ref}}">
                    <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Vendor</th>
		            <th>Stock</th>
		            <th>Purchase Format</th>
		            <th>Purchase Price</th>
		            <th>QTY</th>
		            <th>Sub Total</th>
		            <th>Disc %</th>
		            <th>Gross</th>
		            <!--<th>Exp. date</th>-->
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
                                <select class="select_picker_supplier form-control" id="supplier" data-live-search="true" name="supplier" onchange="Reload();">
                                    <option value="0">--Select--</option>
                                        @foreach($Suppliers as $list)
                                        <option value="{{ $list->id }}" {{ (old('supplier') == $list->id ||($supplier) == $list->id  ) ? 'selected':'' }}>{{ $list->supplier }}({{ $list->s_code }})</option>
                                        @endforeach
                                </select>
                            </div>
                        </td>
                        <td> <div class="form-group" style="width:300px;">
                                <select class="select_picker_stockid form-control" id="stockid" data-live-search="true" name="stockid" onchange="Reload();" >
                                    <option value="">--Select--</option>
                                    @foreach($InventoryList as $list)
                                    <option value="{{ $list->id }}" {{ (old('stockid') == $list->id ||($stockid) == $list->id  ) ? 'selected':'' }}>{{ $list->item_description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
		               <td> <select id="sformat" name="pformat" style="width:150px;" class="form-control" onchange="DoOnselectFormat()">
                				<option value="">-Select-</option>
                				    @foreach($PurchaseFormat as $list)
                                    <option value="{{ $list->id }}" {{ (old('pformat') == $list->id ||($pformat) == $list->id  ) ? 'selected':'' }}>{{ $list->format }}</option>
                                    @endforeach
                				</select>
                		</td>
                		<td><input type="text" class="form-control"  id="spr" name="spr" value="{{number_format(0,2, '.', ',')}}"   style="text-align: right;width:100px; " onblur='DoAfterFormat()'></td>
                		<td><input type="number" class="form-control" id="qty"name="qty" value=""   style="width:70px; " onblur='DoAfterFormat()'></td>
                		<td><input type="text" class="form-control" id="subt" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
		               <td><input type="text" class="form-control"  id="disc" value="0"   style="text-align: right;width:50px; " onblur='DoAfterFormat()' ></td>
		               <td><input type="text" class="form-control"  id="gross" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
		               <!--<td><input type="date" name="expdate" value="{{$expdate}}"   class="form-control" style="width:150px;"></td>-->
		               <td>
		               <button type="submit" class="btn btn-primary" name="add">Add</button>
		               </td>
		              
		               </tr>
		               @foreach($InventoryRecords as $list)
    		           <tr>
    		               <td>{{$i++}} </td>
    		               <td>{{$list->supplier?$list->supplier:"NA"}} </td>
    		               <td>{{$list->item}} </td>
    		               <td>{{$list->format}} </td>
    		               <td style="text-align:right">{{number_format($list->format_price,2, '.', ',')}} </td>
    		               <td>{{$list->formatqty}} </td>
    		               <td style="text-align:right">{{number_format($list->format_price*$list->formatqty,2, '.', ',')}} </td>
    		               <td> {{$list->disc_perc}} </td>
    		               <td style="text-align:right">{{number_format(($list->format_price*$list->formatqty - $list->format_price*$list->formatqty*$list->disc_perc*0.01),2, '.', ',')}} </td>
    		               @php $grosstotal +=$list->format_price*$list->formatqty - $list->format_price*$list->formatqty*$list->disc_perc*0.01; @endphp
    		               <td> <a onclick="deletefunc('{{$list->id}}','{{$list->item}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a></td>
    		            </tr>
    		            @endforeach
		                <tr>
		                    <td colspan =8> Total </td>
		                    <td style="text-align:right">{{number_format($grosstotal,2, '.', ',')}} </td>
		                    <td><button type="submit" class="btn btn-primary" name="post">Batch</button> </td>
		                </tr>  
		           
		            </tbody>
		      </table>
		      <br>
		      <br>
		      <br>
		     </div>
		     </form>
		     <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable2" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Reference No</th>
					<th>Gross</th>
					<th>Status</th>
		            <th>Action</th>
		          </tr>
		        </thead>     
		        <tbody>
		        
		          @php
		          $i=1;
		          $id='id';
		          $grosstotal=0;
		          @endphp
		               
		               @foreach($RequisiteItemSum as $list)
    		           <tr>
    		               <td>{{$i++}} </td>
    		               <td>{{$list->ref_no}} </td>
    		               <td style="text-align:right">{{number_format($list->SumTotal,2, '.', ',')}} </td>
    		               <td>{{$list->status}} </td>
    		               @php $grosstotal +=$list->SumTotal; @endphp
    		               <td> <a onclick="deletefunc('{{$list->id}}','{{$list->item}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a></td>
    		            </tr>
    		            @endforeach
		                <tr>
		                    <td colspan =2> Total </td>
		                    <td style="text-align:right">{{number_format($grosstotal,2, '.', ',')}} </td>
                                
		                    <td> </td>
		                    <td> </td>

		                </tr>  
		           
		            </tbody>
		      </table>
		      <br>
		      <br>
		      <br>
		     </div>
            </div>
        </div>
    
     </div>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $('.select_picker_supplier').selectpicker({
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
    function editbatch(ref)
    {
        document.getElementById('ref').value = ref;
        Reload();
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
   function DoOnselectFormat()
    {
        //sp.replace(/\,/g,''),10).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        var id=document.getElementById('sformat').value;
        var sp = parseFloat(document.getElementById('sp'+id).value.replace(/\,/g,''),10); 
         if (isNaN(sp))sp=0;
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
  function DoAfterFormat()
    {
        var id=document.getElementById('sformat').value;
        var sp = parseFloat(document.getElementById('spr').value.replace(/\,/g,''),10); 
        if (isNaN(sp))sp=0;
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
