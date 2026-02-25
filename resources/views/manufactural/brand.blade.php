@extends('layouts.layout')
@section('pageTitle')
    Product Brand
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Setup</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Brand Setup</a></li>
         
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
                <form method="post">
                {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Manufacturer</label>
                                    <select  class="form-control" name="manufacturer" >
                                     <option value="">--Select--</option>
                                          @foreach($Manufacture as $list)
                                     <option value="{{ $list->id }}" {{ (old('manufacturer') == $list->id ||($manufacturer) == $list->id  ) ? 'selected':'' }}>{{ $list->manufacturer }}</option>
                                          @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Brand</label>
                                    <?php if($brand=='') $brand= old('brand'); ?>
                                    <input type="text" class="form-control"  value="{{$brand}}" required name="brand">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Inventory Account</label>
                                    <select class="select_picker_stock form-control"  data-live-search="true" name="stockaccount"  >
                                        <option value="">--Select--</option>
                                        @foreach($AccountListStock as $list)
                                        <option value="{{ $list->id }}" {{ (old('stockaccount') == $list->id ||($stockaccount) == $list->id  ) ? 'selected':'' }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Sales Income Account</label>
                                    <select class="select_picker_sales form-control"  data-live-search="true" name="salesaccount"  >
                                        <option value="">--Select--</option>
                                        @foreach($AccountListSales as $list)
                                        <option value="{{ $list->id }}" {{ (old('salesaccount') == $list->id ||($salesaccount) == $list->id  ) ? 'selected':'' }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">COS Account</label>
                                    <select class="select_picker_cos form-control"  data-live-search="true" name="cosaccount"  >
                                        <option value="">--Select--</option>
                                        @foreach($AccountListCOS as $list)
                                        <option value="{{ $list->id }}" {{ (old('cosaccount') == $list->id ||($cosaccount) == $list->id  ) ? 'selected':'' }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Disc Account</label>
                                    <select class="select_picker_disc form-control" data-live-search="true" name="discaccount"  >
                                        <option value="">--Select--</option>
                                        @foreach($AccountListCOS as $list)
                                        <option value="{{ $list->id }}" {{ (old('discaccount') == $list->id ||($discaccount) == $list->id  ) ? 'selected':'' }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="addnew">Create</button>
                    </div>
                </form>
                
                <!--===================================================-->
                <!-- End Inline Form  -->
<div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		          
		            <th>S/N</th>
		            <th>Manufacturer</th>
		            <th>Brand</th>
		            <th>Inventory Account</th>
		            <th>Sales Account</th>
		            <th>COS Account</th>
		            <th>Discount Account</th>
		            <th>Action</th>
		           
		            		            
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($BrandList as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td>{{ $list->manufacturer}} </td>
		               <td>{{ $list->brand}}</td>
		               <td>{{ $list->stock}}</td>
		               <td>{{ $list->sales}}</td>
		               <td>{{ $list->cos}}</td>
		               <td>{{ $list->disc}}</td>
		               <td>
		               <a onclick="editfunc('{{$list->id}}','{{$list->manufacturerid}}','{{$list->brand}}','{{$list->inv_stock_account}}','{{$list->inv_sales_account}}','{{$list->inv_disc_account}}','{{$list->inv_cos_account}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
		               <a onclick="deletefunc('{{$list->id}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
		               </td>
		              
		               </tr>
		            @endforeach
		            </tbody>
		                   
		      </table>
		     </div>
            </div>
        </div>
    <div id="editModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Brand Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="id" name="id">
                      <div class="col-sm-12">
			            <div class="form-group">
                      <label class="control-label"><h5>Manufacturer: </h5></label>
                      <select  class="form-control" id="manu"name="manufacturer" >
                                     <option value="">--Select--</option>
                                          @foreach($Manufacture as $list)
                                     <option value="{{ $list->id }}" >{{ $list->manufacturer }}</option>
                                          @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                      <label class="control-label"><h5>Brand: </h5></label>
                      <input type="text" class="form-control" id="brand" name="brand">
                        </div>
                      </div>
                      <div class="col-sm-12">
			            <div class="form-group">
                      <label class="control-label"><h5>Inventory Account: </h5></label>
                      <select  class="form-control" id="stockaccount-id"name="stockaccount" >
                                        @foreach($AccountListStock as $list)
                                        <option value="{{ $list->id }}"  }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			            <div class="form-group">
                      <label class="control-label"><h5>Sale Account: </h5></label>
                      <select  class="form-control" id="salesaccount-id"name="salesaccount" >
                                     @foreach($AccountListSales as $list)
                                        <option value="{{ $list->id }}"  }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			            <div class="form-group">
                      <label class="control-label"><h5>COS Account: </h5></label>
                      <select  class="form-control" id="cosaccount-id"name="cosaccount" >
                                     @foreach($AccountListCOS as $list)
                                        <option value="{{ $list->id }}"  }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			            <div class="form-group">
                      <label class="control-label"><h5>Disc Account: </h5></label>
                      <select  class="form-control" id="discaccount-id"name="discaccount" >
                                     @foreach($AccountListDisc as $list)
                                        <option value="{{ $list->id }}"  }}>{{ $list->accountdescription }}</option>
                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
    <!--modal for deleting record-->
    <div id="deleteModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Brand Record</h4>
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
                     <center><h1 style="color:black;">Are you sure?</h1></center>
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
        <!--/// content end here -->
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
</style>
@stop
@section('scripts')

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
$('.select_picker_stock').selectpicker({
          style: 'btn-default',
          size: 4
        });
        $('.select_picker_sales').selectpicker({
          style: 'btn-default',
          size: 4
        });
        $('.select_picker_disc').selectpicker({
          style: 'btn-default',
          size: 4
        });
        $('.select_picker_cos').selectpicker({
          style: 'btn-default',
          size: 4
        });
        
    function editfunc(id,manu,brand,stock,sales,disc,cos)
    {
        document.getElementById('id').value = id;
        document.getElementById('manu').value = manu;
        document.getElementById('brand').value = brand;
        document.getElementById('stockaccount-id').value = stock;
        document.getElementById('salesaccount-id').value = sales;
        document.getElementById('discaccount-id').value = disc;
        document.getElementById('cosaccount-id').value = cos;
        
        $("#editModal").modal('show')
    }
   function deletefunc(id)
    {
        document.getElementById('deleteid').value = id;
                     
        $("#deleteModal").modal('show')
    }
    
             
</script>



  
@stop
