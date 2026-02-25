@extends('layouts.layout')
@section('pageTitle')
    Inventory Setup
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
            <li><a href="#">Inventory Setup</a></li>
         
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
	        <div class="panel-footer text-left">
                        <button class="btn btn-success" type="button" onclick="Addnew()">Add New</button>
            </div>
            <!-- display selected inventory detail if exist-->
            @if($SelectItemdetails)
                <form method="post">
                {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Brand</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->brand}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Item Category</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->category}}" readonly>
                                    
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Item Description</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->item_description}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Barcode</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->bar_code}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Min. SKU</label>
                                    <input type="text" class="form-control"  value="{{$SelectItemdetails->format}}" readonly>
                                    
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            @if($SelectItemdetails->has_color==1)
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Has difference color <span class="btn-success glyphicon glyphicon-ok"></span></label>
                                </div>
                            </div>
                             @endif
                             @if($SelectItemdetails->has_size==1)
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Has difference sizes<span class="btn-success glyphicon glyphicon-ok"></span></label>
                                </div>
                            </div>
                             @endif
                             @if($SelectItemdetails->has_serialno==1)
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Has serial number<span class="btn-success glyphicon glyphicon-ok"></span></label>
                                </div>
                            </div>
                             @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="text-right">
                                        @php 
                                        $st=$SelectItemdetails;
                                        @endphp 
                                        <button class="btn btn-success" type="button" onclick="editEventoryfunc('{{$st->id}}','{{$st->catid}}','{{$st->brandid}}','{{$st->item_description}}','{{$st->minsku}}','{{$st->vat}}','{{$st->has_color}}','{{$st->has_size}}','{{$st->has_serialno}}','{{$st->bar_code}}')"><span class="glyphicon glyphicon-pencil"></span>edit</button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-4">
                      <h5 class="form-group">Measuring Format</h5>
                        <div class="table-responsive" style="font-size: 11px; padding:10px;">
                            <table id="mytable" class="table table-bordered table-striped table-highlight">
                		        <thead>
                		          <tr bgcolor="#c7c7c7">
                		            <th>S/N</th>
                		            <th>Format</th>
                		            <th>{{$SelectItemdetails->format}} QTY </th>
                		            <th></th>
                		          </tr>
                		        </thead>
                		        <tbody>
                		          @php $i=1; @endphp
                		            @foreach($ItemMFormat as $list)
                		               <tr>
                    		                <td>{{ $i++ }} </td>
                    		               <td>{{$list->format}} </td>
                    		               <td>{{$list->qty}} </td>
                    		               <td>
                        		               <a onclick="editMfunc('{{$list->id}}','{{$list->m_id}}','{{$list->qty}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
                        		               <a onclick="deleteMfunc('{{$list->id}}','{{$list->format}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
                    		               </td>
                		               </tr>
                		            @endforeach
                		            <tr>
                		               <td colspan=5><div class="text-right">
                                                <button class="btn btn-success btn-xs" type="button" onclick="Mnewformat()"><span class="glyphicon glyphicon-plus"></span>new</button>
                                            </div> </td>
                		               
                		               </tr>
		                        </tbody>
		                    </table>
		                </div>
		                
                        
                    </div>
                    <div class="col-sm-4">
                      <h5 class="form-group">Default Purchase Format</h5>
                        <div class="table-responsive" style="font-size: 11px; padding:10px;">
                            <table id="mytable" class="table table-bordered table-striped table-highlight">
                		        <thead>
                		          <tr bgcolor="#c7c7c7">
                		            <th>S/N</th>
                		            <th>Format</th>
                		            <th>{{$SelectItemdetails->format}} QTY </th>
                		            <th>price</th>
                		            <th></th>
                		          </tr>
                		        </thead>
                		        <tbody>
                		          @php $i=1; @endphp
                		            @foreach($PurchaseFormat as $list)
                		               <tr>
                    		                <td>{{ $i++ }} </td>
                    		               <td>{{$list->format}} </td>
                    		               <td>{{$list->minskuqty}} </td>
                    		               <td>{{$list->price}} </td>
                    		               <td>
                        		               <a onclick="editPfunc('{{$list->id}}','{{$list->formatid}}','{{$list->price}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
                        		               <a onclick="deletePfunc('{{$list->id}}','{{$list->format}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
                    		               </td>
                		               </tr>
                		            @endforeach
                		            <tr>
                		               <td colspan=5><div class="text-right">
                                                <button class="btn btn-success btn-xs" type="button" onclick="newPformat()"><span class="glyphicon glyphicon-plus"></span>new</button>
                                            </div> </td>
                		               
                		               </tr>
		                        </tbody>
		                    </table>
		                </div>
		                
                        
                    </div>
                    <div class="col-sm-4">
                        <h5 class="form-group">Selling Format</h5>
                        <div class="row">
                            
                            <div class="table-responsive" style="font-size: 11px; padding:10px;">
                                <table id="mytable" class="table table-bordered table-striped table-highlight">
                		        <thead>
                		          <tr bgcolor="#c7c7c7">
                		            <th>S/N</th>
                		            <th>Format</th>
                		            <th>{{$SelectItemdetails->format}} QTY</th>
                		            <th>price</th>
                		            <th></th>
                		          </tr>
                		        </thead>
                		               
                		        <tbody>
                		        
                		          @php
                		          $i=1;
                		          @endphp
                		            @foreach($SalesFormat as $list)
                		               <tr>
                		               <td>{{ $i++ }} </td>
                		               <td>{{$list->format}} </td>
                		               <td>{{$list->minskuqty}} </td>
                		               <td>{{$list->price}} </td>
                		               <td>
                		               <a onclick="editSfunc('{{$list->id}}','{{$list->formatid}}','{{$list->price}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
                		               <a onclick="deleteSfunc('{{$list->id}}','{{$list->format}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
                		               </td>
                		              
                		               </tr>
                		            @endforeach
                		            <tr>
                		               <td colspan=5><div class="text-right">
                                                <button class="btn btn-success btn-xs" type="button" onclick="newSformat()"><span class="glyphicon glyphicon-plus"></span>new</button>
                                            </div> </td>
                		               
                		               </tr>
                		            </tbody>
                		      </table>
                		    </div>
                        </div>
                        
                    </div>
            </div>
            @endif
             <!-- end display selected inventory detail if exist-->
                <!--===================================================-->
                <!-- End Inline Form  -->
            <div class="table-responsive" style="font-size: 11px; padding:10px;">
                <table id="mytable" class="table table-bordered table-striped table-highlight">
		        <thead>
		          <tr bgcolor="#c7c7c7">
		            <th>S/N</th>
		            <th>Brand</th>
		            <th>Eventory Item</th>
		            <th>Barcode</th>
		            <th>Category</th>
		            <th></th>
		          </tr>
		        </thead>
		               
		        <tbody>
		        
		          @php
		          $i=1;
		          @endphp
		           
		            @foreach($InventoryList as $list)
		                           
		               <tr>
		               <td>{{ $i++ }} </td>
		               <td> {{$list->brand}}</td>
		               <td> {{$list->item_description}}</td>
		               <td> {{$list->bar_code}}</td>
		               <td> {{$list->category}}</td>
		               <td>
		               <a onclick="SelectInventory('{{$list->id}}')" class="btn btn-success  glyphicon glyphicon-edit btn-xs"></a>&nbsp;
		               <a onclick="deletefunc('{{$list->id}}','{{$list->item_description}}')" class="btn btn-danger glyphicon glyphicon-remove btn-xs"></a>
		               </td>
		              
		               </tr>
		            @endforeach
		            </tbody>
		      </table>
		     </div>
            </div>
        </div>
    <div id="editModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modifiy Selected Inventory</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="invid" name="id">
                    <div class="col-sm-12">
			            <div class="form-group">
                              <label class="control-label">Brand</label>
                                    <select  class="form-control" name="brand" id="brand" >
                                     <option value="">--Select--</option>
                                    @foreach($BrandList as $list)
                                     <option value="{{ $list->id }}" >{{ $list->brand}}</option>
                                    @endforeach
                                   </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                              <label class="control-label">Item Category</label>
                                    <select  class="form-control" name="category" id="category" >
                                     <option value="">--Select--</option>
                                    @foreach($CategoryList as $list)
                                     <option value="{{ $list->id }}" >{{ $list->category }}</option>
                                    @endforeach
                                   </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                             <label class="control-label">Item Description</label>
                            
                            <input type="text" class="form-control"  required name="item" id="item">
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                             <label class="control-label">Barcode</label>
                            
                            <input type="text" class="form-control"  required name="barcode" id="bc">
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                            <label class="control-label">Min. SKU</label>
                            <select  class="form-control" name="mskuformat"  id="mskuformat">
                             <option value="">--Select--</option>
                            @foreach($MFormat as $list)
                             <option value="{{ $list->id }}">{{ $list->format}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
			            <div class="form-group">
			                <label class="control-label">Tax</label>
                            <select  class="form-control" name="taxperc" id="taxperc">
                            
                            @foreach($TaxPerc as $list)
                             <option value="{{ $list->perc }}" >{{ $list->perc}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
			            <div class="form-group">
			                <label class="control-label">Has Color?</label>
                            <select  class="form-control" name="hcalor" id="hcalor">
                            
                            @foreach($YesNo as $list)
                             <option value="{{ $list->id }}" >{{ $list->yn}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Has Size?</label>
                            <select  class="form-control" name="hsize" id="hsize">
                             
                            @foreach($YesNo as $list)
                             <option value="{{ $list->id }}">{{ $list->yn}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            
                             <label class="control-label">Has Serial Number?</label>
                            <select  class="form-control" name="hserialno" id="hserialno">
                            
                            @foreach($YesNo as $list)
                             <option value="{{ $list->id }}" >{{ $list->yn}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="modinventory">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
        <div id="newModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Create New inventory</h4>
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
                              <label class="control-label">Brand</label>
                                    <select  class="form-control" name="brand" >
                                     <option value="">--Select--</option>
                                    @foreach($BrandList as $list)
                                     <option value="{{ $list->id }}" {{ (old('brand') == $list->id ||($brand) == $list->id  ) ? 'selected':'' }}>{{ $list->brand}}</option>
                                    @endforeach
                                   </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                              <label class="control-label">Item Category</label>
                                    <select  class="form-control" name="category" >
                                     <option value="">--Select--</option>
                                    @foreach($CategoryList as $list)
                                     <option value="{{ $list->id }}" {{ (old('category') == $list->id ||($category) == $list->id  ) ? 'selected':'' }}>{{ $list->category }}</option>
                                    @endforeach
                                   </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                             <label class="control-label">Item Description</label>
                            <?php if($item=='') $item= old('item'); ?>
                            <input type="text" class="form-control"  value="{{$item}}" required name="item">
                        </div>
                    </div>
                     <div class="col-sm-12">
			            <div class="form-group">
                             <label class="control-label">Barcode</label>
                            <?php if($barcode=='') $item= old('barcode'); ?>
                            <input type="text" class="form-control"  value="{{$barcode}}" required name="barcode">
                        </div>
                    </div>
                    <div class="col-sm-12">
			            <div class="form-group">
                            <label class="control-label">Min. SKU</label>
                            <select  class="form-control" name="mskuformat" >
                             <option value="">--Select--</option>
                            @foreach($MFormat as $list)
                             <option value="{{ $list->id }}" {{ (old('mskuformat') == $list->id ||($mskuformat) == $list->id  ) ? 'selected':'' }}>{{ $list->format}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
			            <div class="form-group">
                            <label class="control-label">Tax</label>
                            <select  class="form-control" name="taxperc" >
                            @foreach($TaxPerc as $list)
                             <option value="{{ $list->perc }}" {{ (old('taxperc') == $list->perc ||($taxperc) == $list->perc  ) ? 'selected':'' }}>{{ $list->perc}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
			            <div class="form-group">
                            <label class="control-label">Has Color?</label>
                            <select  class="form-control" name="hcalor" >
                             <option value="">--Select--</option>
                            @foreach($YesNo as $list)
                             <option value="{{ $list->id }}" {{ (old('hcalor') == $list->id ||($hcalor) == $list->id  ) ? 'selected':'' }}>{{ $list->yn}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Has Size?</label>
                            <select  class="form-control" name="hsize" ">
                             <option value="">--Select--</option>
                            @foreach($YesNo as $list)
                             <option value="{{ $list->id }}" {{ (old('hsize') == $list->id ||($hsize) == $list->id  ) ? 'selected':'' }}>{{ $list->yn}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                             <label class="control-label">Has Serial Number?</label>
                            <select  class="form-control" name="hserialno">
                             <option value="">--Select--</option>
                            @foreach($YesNo as $list)
                             <option value="{{ $list->id }}" {{ (old('hserialno') == $list->id ||($hserialno) == $list->id  ) ? 'selected':'' }}>{{ $list->yn}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="addnew">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
        <div id="pnewModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Purchase Price</h4>
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
                            <label class="control-label">Format</label>
                                <select  class="form-control" name="pformat" >
                                 <option value="">--Select--</option>
                                @foreach($ItemMFormat as $list)
                                 <option value="{{ $list->id}}" {{ (old('pformat') == $list->id ||($pformat) == $list->id) ? 'selected':'' }}>{{ $list->format}}</option>
                                @endforeach
                               </select>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Price</label>
                            <?php if($pprice=='') $pprice= old('pprice'); ?>
                            <input type="text" class="form-control"  value="{{$pprice}}" required name="pprice">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="purchasenew">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
        <div id="snewModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Selling Price</h4>
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
                            <label class="control-label">Format</label>
                                    <select  class="form-control" name="sformat" >
                                     <option value="">--Select--</option>
                                    @foreach($ItemMFormat as $list)
                                     <option value="{{ $list->id}}" {{ (old('sformat') == $list->id ||($sformat) == $list->id) ? 'selected':'' }}>{{ $list->format}}</option>
                                    @endforeach
                                   </select>
                        </div>
                      </div>

                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Price</label>
                            <?php if($sprice=='') $fprice= old('sprice'); ?>
                            <input type="text" class="form-control"  value="{{$sprice}}" required name="sprice">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="sellingnew">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
        <div id="MnewModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Measuring</h4>
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
                            <label class="control-label">Format</label>
                                    <select  class="form-control" name="mformat" >
                                     <option value="">--Select--</option>
                                    @foreach($MFormat as $list)
                                     <option value="{{ $list->id}}" {{ (old('mformat') == $list->id ||($mformat) == $list->id) ? 'selected':'' }}>{{ $list->format}}</option>
                                    @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">@if($SelectItemdetails){{$SelectItemdetails->format}}  Quantity @endif</label>
                            <?php if($mqty=='') $fqty= old('mqty'); ?>
                            <input type="text" class="form-control"  value="{{$sqty}}" required name="mqty">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="mformatnew">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
         <div id="supdateModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Selling Price</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="sid" name="fid">
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Format</label>
                                    <select  class="form-control" name="format" id="suformat">
                                     <option value="">--Select--</option>
                                    @foreach($ItemMFormat as $list)
                                     <option value="{{ $list->id}}">{{ $list->format}}</option>
                                    @endforeach
                                   </select>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" class="form-control"  required name="price" id="suprice">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="spupdate">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
         <div id="pupdateModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Purchase Price</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    
                      <input type="hidden" class="form-control" id="pid" name="fid">
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Format</label>
                                    <select  class="form-control" name="format" id="puformat" >
                                     <option value="">--Select--</option>
                                    @foreach($ItemMFormat as $list)
                                     <option value="{{ $list->id}}" >{{ $list->format}}</option>
                                    @endforeach
                                   </select>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" class="form-control"   required name="price" id="puprice">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ppupdate">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            
                </form>
            </div>
            
          </div>
        </div>
        <div id="mfupdateModal" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Measurin Format</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                      <input type="hidden" class="form-control" id="mid" name="fid">
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Format</label>
                            <select  class="form-control" name="format" id="muformat" >
                                 <option value="">--Select--</option>
                                @foreach($MFormat as $list)
                                 <option value="{{ $list->id}}" >{{ $list->format}}</option>
                                @endforeach
                           </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
			             <div class="form-group">
                            <label class="control-label">Qty</label>
                            <input type="text" class="form-control"   required name="qty" id="mqty">
                        </div>
                      </div>
                      </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="mfupdate">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
          </div>
        </div>
    <!--modal for deleting record-->
     <div id="deleteModalp" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Purchase Format</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="deletepid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h1 style="color:black;">Are you sure <div id="contentpid"></div>?</h1></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="delp" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
                </form>
            </div>
            
          </div>
    </div>
    <div id="deleteModalm" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Purchase Format</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="deletemid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h1 style="color:black;">Are you sure <div id="contentmid"></div>?</h1></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="delm" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
                </form>
            </div>
            
          </div>
    </div>
    <div id="deleteModals" class="modal fade" >
        <div class="modal-dialog box box-default" role="document" style="color:black;font-size:24px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Sale Format</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post"  role="form">
                    {{ csrf_field() }}
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <input type="hidden" class="form-control" id="deletesid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h1 style="color:black;">Are you sure <div id="contentsid"></div>?</h1></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="dels" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
                    <input type="hidden" class="form-control" id="deleteid" name="deleteid" value="">
                    <div class="col-sm-12">
                        <center><h1 style="color:black;">Are you sure <div id="content5"></div>?</h1></center>
                        
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="delinv" class="btn btn-success">Yes</button>
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

    function editfunc(id,cat)
    {
        document.getElementById('id').value = id;
        document.getElementById('category').value = cat;
        
        
        $("#editModal").modal('show')
    }
    
    function editEventoryfunc(id,cat,br,item,msku,tx,c,sz,sn,bc)
    {
        document.getElementById('invid').value = id;
         document.getElementById('brand').value = br;
         document.getElementById('category').value = cat;
         document.getElementById('item').value = item;
         document.getElementById('mskuformat').value = msku;
         document.getElementById('taxperc').value = tx;
         document.getElementById('hcalor').value = c;
         document.getElementById('hsize').value = sz;
         document.getElementById('hserialno').value = sn;
        document.getElementById('bc').value = bc;
        //document.getElementById('category').value = cat;
        
        
        $("#editModal").modal('show')
    }
   function deletefunc(id,item)
    {
        document.getElementById('deleteid').value = id;
        document.getElementById('content5').innerHTML = item;
                     
        $("#deleteModal").modal('show')
    }
    
     function deletePfunc(id,f)
    {
        
        document.getElementById('deletepid').value = id;
        document.getElementById('contentpid').innerHTML = f;
                     
        $("#deleteModalp").modal('show')
    }
      function deleteMfunc(id,f)
    {
        
        document.getElementById('deletemid').value = id;
        document.getElementById('contentmid').innerHTML = f;
                     
        $("#deleteModalm").modal('show')
    }
     function deleteSfunc(id,f)
    {
        //alert("djfjf");
        document.getElementById('deletesid').value = id;
        document.getElementById('contentsid').innerHTML = f;
                     
        $("#deleteModals").modal('show')
    }
    function Addnew()
    {
                     
        $("#newModal").modal('show')
    }
    function newPformat()
    {
        $("#pnewModal").modal('show')
    }
    function newSformat()
    {
        $("#snewModal").modal('show')
    }
    function editPfunc(id,f,p)
    {
        document.getElementById('pid').value = id;
        document.getElementById('puformat').value = f;
        document.getElementById('puprice').value = p;
        $("#pupdateModal").modal('show')
    }
    function editMfunc(id,f,q)
    {
        document.getElementById('mid').value = id;
        document.getElementById('muformat').value = f;
        document.getElementById('mqty').value = q;
        $("#mfupdateModal").modal('show')
    }
    function editSfunc(id,f,p)
    {
        document.getElementById('sid').value = id;
        document.getElementById('suformat').value = f;
        document.getElementById('suprice').value = p;
        $("#supdateModal").modal('show')
    }
    
    function SelectInventory(id)
    {
        document.getElementById('noid').value = id;
       document.forms["noform"].submit();
    }
     
     function Mnewformat()
    {
        $("#MnewModal").modal('show')
    }        
</script>



  
@stop
