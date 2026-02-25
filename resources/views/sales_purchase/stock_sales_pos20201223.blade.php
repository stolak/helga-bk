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
	           <div id="hiddensp">
	            @foreach($SalesFormat as $list)
                <input type="hidden" id="sp{{$list->id}}"  value="{{$list->price}}">
                @endforeach
            </div>
                <form method="post" id="mainform" name="mainform">
                    {{ csrf_field() }}
                    <div class="panel-body" >
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Customer Names(Optional)</label>
                                        <input type="text" name="cusname" value="{{$cusname}}"   class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <select id="warehouse" name="warehouse"  class="form-control" >
                				    <option value="">-Select-</option>
                				    @foreach($WareHouses as $list)
                                    <option value="{{ $list->warehouseid }}" {{ (old('warehouse') == $list->warehouseid ||($warehouse) == $list->warehouseid  ) ? 'selected':'' }}>{{ $list->warehouse }}</option>
                                    @endforeach
                				</select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Inventory items</label>
                                    <select class="select_picker_stockid form-control" id="stockid" data-live-search="true" name="stockid" onchange="ResetAndLoadNewFormat();" >
                                    <option value="">--Select--</option>
                                    @foreach($InventoryList as $list)
                                    <option value="{{ $list->id }}" {{ (old('stockid') == $list->id ||($stockid) == $list->id  ) ? 'selected':'' }}>{{ $list->item_description }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">S. Format</label>
                                    <div id="formatdiv" ><select id="sformat" name="sformat"  class="form-control" onchange="DoAfterFormat()" >
                				<option value="">-Select-</option>
                				    @foreach($SalesFormat as $list)
                                    <option value="{{ $list->id }}" {{ (old('sformat') == $list->id ||($sformat) == $list->id  ) ? 'selected':'' }}>{{ $list->format }}</option>
                                    @endforeach
                				</select>
                				</div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Selling price</label>
                                    <input type="text" class="form-control"  id="spr" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right; ">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Qty</label>
                                   <input type="number" class="form-control" id="qty"name="qty" value=""   onkeyup='DoAfterFormat()'>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Subtotal</label>
                                   <input type="text" class="form-control" id="subt" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right; ">
                                </div>
                            </div>
                            
                             <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label"> <br><br></label>
                                   <button type="submit" class="btn btn-primary" name="add">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   <input type="hidden" class="form-control"  id="disc" value="0"   > 
                   <input type="hidden" class="form-control"  id="gross" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; ">
            <div class="table-responsive" style=" padding:10px; ">
                <table id="mytable" class="table table-bordered table-striped table-highlight table-responsive">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Stock</th>
		            <!--<th>Sales Format</th>-->
		            <th>Selling Price</th>
		            <th>QTY</th>
		            <!--<th>Sub Total</th>-->
		            <!--<th>Disc %</th>-->
		            <th>Gross</th>
		            <th>Warehouse</th>
		            <th>Action</th>
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          $id='id';
		          $grosstotal=0;
		          @endphp
		              
		               @foreach($InventoryRecords as $list)
    		           <tr>
    		               <td>{{$i++}} </td>
    		               <td>{{$list->item}} </td>
    		               <td>{{number_format($list->formatprice,2, '.', ',')}}/{{$list->format}} </td>
    		               <!--<td style="text-align:right">{{number_format($list->formatprice,2, '.', ',')}} </td>-->
    		               <td>{{$list->skuqty/$list->formatqty}} </td>
    		              <!-- <td style="text-align:right">{{number_format($list->subtotal,2, '.', ',')}} </td>-->
    		              <!-- <td> {{$list->disc_perc}} </td>-->
    		               <td style="text-align:right">{{number_format($list->ftotal,2, '.', ',')}} </td>
    		               @php $grosstotal +=$list->ftotal; @endphp
    		               <td >{{$list->warehouse}} </td>
    		               <td> <a onclick="deletefunc('{{$list->id}}','{{$list->item}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a></td>
    		            </tr>
    		            @endforeach
		                <tr>
		                    <td colspan =3> <label class="control-label">Transaction date</label>
		                    <input type="date" name="transdate" value="{{$transdate}}"   class="form-control" style="width:150px;"></td>
		                    
		                    <td > Total </td>
                                    
		                    <td style="text-align:right">{{number_format($grosstotal,2, '.', ',')}} </td>
		                    <td > </td>
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
<style>
            .select_picker_stockid{
            height:40px !important;
              z-index: 100;
        }
        .select_picker_stockid{
                 border: 1px solid #ccc !important; 
             border-radius: 0px !important; 
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
  function  ResetAndLoadNewFormat()
    {	
        
        var stockid=document.getElementById('stockid').value;
        $.ajax(
            {
			url: murl +'/load-sales-format',
			type: "post",
			data: {'stockid': stockid, '_token': $('input[name=_token]').val()},
			success: function(data){
			    console.log(data);
		        $('#hiddensp').empty();
		        var retdata='';
		        var formatdom='<select id="sformat" name="sformat" style="width:150px;" class="form-control" onchange="DoAfterFormat()" ><option value="">-Select-</option>';
			    $.each(data, function(index, obj){
			        retdata +=' <input type="hidden" id="sp'+obj.id +'"  value="'+obj.price +'">';
                    formatdom += '<option value="'+obj.id+'" >'+ obj.format +'</option>';
			    }
			    );
			    formatdom +='</select>';
			    $('#formatdiv').empty();
			    $('#hiddensp').empty();
			     $('#formatdiv').append(formatdom);
			     $('#hiddensp').append(retdata);
			}
		});
        //document.forms["mainform"].submit();
        //return;
    }
  
</script>



  
@stop
