@extends('layouts.layout')
@section('pageTitle')
    Stock Transfer
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Transfer</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Stock transfer</a></li>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Product Items</label>
                                    <select class="select_picker_stockid form-control" id="item" data-live-search="true" name="item" onchange="Reload();" >
                                        <option value="">--Select--</option>
                                        @foreach($InventoryList as $list)
                                        <option value="{{ $list->id }}" {{ (old('item') == $list->id ||($item) == $list->id  ) ? 'selected':'' }}>{{ $list->item_description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Format</label>
                                    <select class="select_picker_stockid form-control" id="tformat" data-live-search="true" name="tformat"  >
                                        <option value="">--Select--</option>
                                        @foreach($SalesFormat as $list)
                                        <option value="{{ $list->formatid }}" {{ (old('tformat') == $list->formatid ||($tformat) == $list->formatid  ) ? 'selected':'' }}>{{ $list->format }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">QTY</label>
                                    <input type="text"  value="{{$tqty}}"   class="form-control" name="tqty">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Source</label>
                                    <select class="select_picker_stockid form-control" id="fromwarehouse" data-live-search="true" name="fromwarehouse" onchange="Reload();" >
                                        <option value="">--Select--</option>
                                        @foreach($SWareHouses as $list)
                                        <option value="{{ $list->warehouseid }}" {{ (old('fromwarehouse') == $list->warehouseid ||($fromwarehouse) == $list->warehouseid  ) ? 'selected':'' }}>{{ $list->warehouse }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Destination</label>
                                    <select class="select_picker_stockid form-control" id="towarehouse" data-live-search="true" name="towarehouse" >
                                        <option value="">--Select--</option>
                                        @foreach($TWareHouses as $list)
                                        <option value="{{ $list->id }}" {{ (old('towarehouse') == $list->id ||($towarehouse) == $list->id  ) ? 'selected':'' }}>{{ $list->warehouse }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="addnew">Save</button>
                    </div>
                    <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Inventory Item</th>
		            <th>Quantity</th>
		            <th>Source</th>
		            <th>Destination</th>
		            <th>Transfered by</th>
		            <th>Received by</th>
		            <th>Transfered date</th>
		            <th>Received date</th>
		            <th>Status</th>
		            <th>Action</th>
		            
		          </tr>
		        </thead>
		        <tbody>
		               @php $sn=1;@endphp
		               @foreach($StockTransferlist as $list)
    		           <tr>
    		               <td>{{$sn++}} </td>
    		               <td>{{$list->item_description}} </td>
    		               <td>{{$list->f_qty}}{{$list->format1}} </td>
    		               <td>{{$list->s_wh}}</td>
    		               <td>{{$list->t_wh}}</td>
    		               <td>{{$list->sname}} </td>
    		               <td>{{$list->tname}} </td>
    		               <td>{{$list->transfered_date}} </td>
    		               <td>{{$list->received_date}} </td>
    		               <td>{{$list->status?'complete':'Pending'}} </td>
    		                <td> 
    		                 @if($list->status==0 && (in_array($list->towarehouse, $mywarehouseArray)) )
    		                    <a onclick="Receivefunc('{{$list->id}}','{{$list->item_description}}:{{$list->f_qty}}{{$list->format1}}')" class="btn btn-success  btn-xs"> Accept</a>
		                    @endif
    		                @if($list->status==0 && Auth::user()->id==$list->transfered_by)
    		                    <a onclick="deletefunc('{{$list->id}}','{{$list->item_description}}:{{$list->f_qty}}{{$list->format1}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
		                    @endif
		                   
		                    </td>
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
                    <input type="hidden" class="form-control" id="deleteid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h3 style="color:black;">Do you really want to delete <div id="content5"></div>?</h3></center>
                        
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
    <div id="receiveModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Receive Stock Transfer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="recID" name="recID" value="">
                    <div class="col-sm-12">
                        <center><h3 style="color:black;">Do you really want to receive this stock <div id="content6"></div>?</h3></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
                </form>
            </div>
            
          </div>
    </div>
        <div id="downwardModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Downward Stock Adjustment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="id-d" name="id">
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label"><h5>Inventory Stock: </h5></label>
                            <input type="text" class="form-control" id="Itemd"  readonly>
                        </div>
                      </div>
                      <div class="col-sm-6">
			             <div class="form-group">
                            <label class="control-label"><h5>Quantity In stock: </h5></label>
                            <input type="text" class="form-control" id="qtyavail-less"  readonly>
                        </div>
                      </div>
                      <div class="col-sm-6">
			             <div class="form-group">
                            <label class="control-label"><h5>Adjustment Date: </h5></label>
                            <input type="date" name="fromdate" value="{{$fromdate}}"   class="form-control" style="width:150px;" >
                        </div>
                      </div>
                      <div class="col-sm-4">
			             <div class="form-group">
                      <label class="control-label"><h5>Format: </h5></label>
                      <div id="divformat-less">
                        <select  class="form-control" id="format"name="format" >
                            <option value="" >No Format</option>
                        </select>
                        </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
			             <div class="form-group">
                      <label class="control-label"><h5>Quantity: </h5></label>
                      <input type="text" class="form-control" id="qty" name="qty">
                        </div>
                      </div>
                      <div class="col-sm-4">
			            <div class="form-group">
                          <label class="control-label"><h5>Estimated value: </h5></label>
                          <input type="text" class="form-control" id="amount" name="amount">
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
                    <button type="submit" class="btn btn-success" name="update-less">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
    function UpwardUpdate(id,item,qtyavail,formatlist)
    {
        document.getElementById('id-u').value = id;
        document.getElementById('qtyavail-up').value = qtyavail;
        // document.getElementById('i').value = desc;
         document.getElementById('Itemu').value = item;
         var divformat = document.getElementById("divformat");
          var sel = '<select  class="form-control" id="format"name="format" >';
          var a = JSON.parse(formatlist);
         for(i = 0; i < a.length; i++){
           sel += '<option value="' + a[i].id +'" >' + a[i].format + '</option>';
         }
        sel += '</select>';
         //alert(sel);
         divformat.innerHTML=sel;
        $("#upwardModal").modal('show')
    }
    function DownwardUpdate(id,item,qtyavail,formatlist)
    {
        document.getElementById('id-d').value = id;
        document.getElementById('qtyavail-less').value = qtyavail;
        // document.getElementById('e_description').value = desc;
         document.getElementById('Itemd').value = item;
         var divformat = document.getElementById("divformat-less");
          var sel = '<select  class="form-control" id="format"name="format" >';
          var a = JSON.parse(formatlist);
         for(i = 0; i < a.length; i++){
           sel += '<option value="' + a[i].id +'" >' + a[i].format + '</option>';
         }
        sel += '</select>';
         //alert(sel);
         divformat.innerHTML=sel;
        $("#downwardModal").modal('show')
    }
   function deletefunc(id,item)
    {
        
        document.getElementById('deleteid').value = id;
        document.getElementById('content5').innerHTML = item;
                     
        $("#deleteModal").modal('show')
    }
    function Receivefunc(id,item)
    {
        
        document.getElementById('recID').value = id;
        document.getElementById('content6').innerHTML = item;
                     
        $("#receiveModal").modal('show')
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
