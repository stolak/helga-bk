@extends('layouts.layout')
@section('pageTitle')
    Room Booking
@endsection

@section('pageHead')
    <div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow">Booking</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Room Booking</a></li>
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
	            @foreach($Rooms as $list)
                <input type="hidden" id="sp{{$list->id}}"  value="{{$list->price}}">
                @endforeach
            </div>
                <form method="post" id="mainform" name="mainform">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Customer Names</label>
                                    <div class="input-group">
										<select class="select_picker_customer form-control" id="customer" data-live-search="true" name="customer" onchange="Reload();">
                                            <option value="">--Select--</option>
                                            @foreach($Customers as $list)
                                            <option value="{{ $list->id }}" {{ (old('customer') == $list->id ||($customer) == $list->id  ) ? 'selected':'' }}>{{ $list->firstname }}{{ $list->middlename }} {{ $list->surname }}</option>
                                            @endforeach
                                        </select>
										<span class="input-group-btn">
                                            <button type="button" class="btn btn-success" onclick="NewCustomer()" >New</button>
                                        </span>
                                    </div>
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
                    <div  >
                <table id="mytable" class="table table-bordered table-striped table-highlight table-responsive">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Room Description</th>
		            <th>Charge/day</th>
		            <th>No of day</th>
		            <th>Total cost</th>
		            <th>Disc %</th>
		            <th>Gross</th>
		            
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
		               <td> <div class="form-group" style="width:250px;" >
                                <select class="select_picker_stockid form-control" id="roomid" data-live-search="true" name="roomid" onchange="DoAfterFormat();" >
                                    <option value="">--Select--</option>
                                    @foreach($Rooms as $list)
                                    <option value="{{ $list->id }}" {{ (old('roomid') == $list->id ||($roomid) == $list->id  ) ? 'selected':'' }}>{{ $list->room_type }}: Room {{$list->room_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                		<td><input type="text" class="form-control"  id="spr" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
                		<td><input type="number" class="form-control" id="qty"name="qty" value=""   style="width:70px; " onkeyup='DoAfterFormat()'></td>
                		<td><input type="text" class="form-control" id="subt" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
		               <td><input type="text" class="form-control"  id="disc" name="disc" value="0"   style="text-align: right;width:70px; " onkeyup='DoAfterFormat()' ></td>
		               <td><input type="text" class="form-control"  id="gross" value="{{number_format(0,2, '.', ',')}}"  readonly style="text-align: right;width:100px; "></td>
		               <!--<td><input type="text" class="form-control"  id="exp-id" name="expdate "value=""  readonly style="text-align: right;width:100px; "></td>-->
		               <td>
		               <button type="submit" class="btn btn-primary" name="add">Add</button>
		               </td>
		              
		               </tr>
		               @foreach($InventoryRecords as $list)
    		           <tr>
    		               <td>{{$i++}} </td>
    		               <td>{{ $list->room_type }}: Room {{$list->room_no}}</td>
    		               <td style="text-align:right">{{number_format($list->daily_charge,2, '.', ',')}} </td>
    		               <td>{{$list->no_of_night}} </td>
    		               <td style="text-align:right">{{number_format($list->no_of_night*$list->daily_charge,2, '.', ',')}} </td>
    		               <td> {{$list->disc}} </td>
    		               @php $ftotal=($list->no_of_night*$list->daily_charge)-($list->no_of_night*$list->daily_charge*$list->disc*0.01);@endphp
    		               <td style="text-align:right">{{number_format($ftotal,2, '.', ',')}} </td>
    		               @php $grosstotal +=$ftotal; @endphp
    		               <td> <a onclick="deletefunc('{{$list->id}}','{{ $list->room_type }}: Room {{$list->room_no}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a></td>
    		            </tr>
    		            @endforeach
		                <tr>
		                    <td colspan =6> Total </td>
		                    <td style="text-align:right">{{number_format($grosstotal,2, '.', ',')}} </td>
		                    <!-- <td>  </td>-->
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
              <h4 class="modal-title">Remove record</h4>
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
                        <center><h1 style="color:black;">Do your really want to delete <div id="content5"></div>?</h1></center>
                        
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
    <div id="customerModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><h5>Names: </h5></label>
                            <input type="text" class="form-control"  name="names">
                        </div>  
                    </div>
                    <row>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><h5>Phone No: </h5></label>
                                <input type="text" class="form-control"  name="phoneno">
                            </div>  
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><h5>Email: </h5></label>
                                <input type="text" class="form-control"  name="email">
                            </div>  
                        </div>
                    </row>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><h5>Address: </h5></label>
                            <input type="text" class="form-control"  name="address">
                        </div>  
                    </div>
                    <row>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><h5>ID Type: </h5></label>
                               <select name="idtype"  class="form-control"  >
                				<option value="">-Select-</option>
                				    @foreach($IdentificationType as $list)
                                    <option value="{{ $list->id }}" {{ (old('idtype') == $list->id ||($idtype) == $list->id  ) ? 'selected':'' }}>{{ $list->identification_type }}</option>
                                    @endforeach
                				</select>
                            </div>  
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><h5>ID No: </h5></label>
                                <input type="text" class="form-control"  name="idno">
                            </div>  
                        </div>
                    </row>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="save" class="btn btn-success">Save</button>
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
    function NewCustomer()
    {
        //document.getElementById('deleteid').value = id;
        //document.getElementById('content5').innerHTML = item;
                     
        $("#customerModal").modal('show')
    }
    
   function  Reload()
        {	
        document.forms["mainform"].submit();
        return;
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
   function DoAfterFormat()
    {
        var id=document.getElementById('roomid').value;
        //alert(id);
        var sp = parseFloat(document.getElementById('sp'+id).value); 
        var qty=document.getElementById('qty').value;
         if(qty=='') qty=0;
        var disc=document.getElementById('disc').value;
        var subt=sp*qty;
        var gross= subt - (disc*subt)*0.01;
        document.getElementById('spr').value=sp.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        document.getElementById('subt').value=subt.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        document.getElementById('gross').value=gross.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
    }
  
  
</script>



  
@stop
