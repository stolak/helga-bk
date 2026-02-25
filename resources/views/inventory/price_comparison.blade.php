@extends('layouts.layout')
@section('pageTitle')
    Price Comparison
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Price list</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Price Comparison</a></li>
         
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
                 <form method="post" id="mainform" name="mainform">
             <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label">Inventory Items</label>
                                        <select class="select_picker_supplier form-control" id="id" data-live-search="true" name="id" onchange="Reload();">
                                        <option value="">--Select--</option>
                                        @foreach($InventoryList as $list)
                                        <option value="{{ $list->id }}" {{ (old('id') == $list->id ||($id) == $list->id  ) ? 'selected':'' }}>{{ $list->item_description }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
             </div>
	        {{ csrf_field() }}
            <!-- display selected inventory detail if exist-->
            @if($SelectItemdetails)
               
                
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Brand</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->brand}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Item Category</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->category}}" readonly>
                                    
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Item Description</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->item_description}}" readonly>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                
                
            @endif
            </form>
             <!-- end display selected inventory detail if exist-->
                <!--===================================================-->
                <!-- End Inline Form  -->
            <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Supplier</th>
		            @foreach($ItemMFormat as $flist)
		            <th>{{$flist->format}}</th>
		             @endforeach
		            
		          </tr>
		        </thead>
		               format
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($Price_listing_by_Suppliers as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td>{{$list->supplier}} </td>
		               @foreach($ItemMFormat as $flist)
		               @php $ptag='price'.$flist->id @endphp
		                <td>{{$list->$ptag}}</td>
		                @endforeach
		               
		              
		               </tr>
		            @endforeach
		            </tbody>
		      </table>
		     </div>
            </div>
        </div>
    </div>
        <!--/// content end here -->
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


$('.select_picker_supplier').selectpicker({
          style: 'btn-default',
          size: 4
        });
    function SelectInventory(id)
    {
        document.getElementById('noid').value = id;
       document.forms["noform"].submit();
    }
    function  Reload()
    {	
    document.forms["mainform"].submit();
    return;
    }
</script>
@stop
