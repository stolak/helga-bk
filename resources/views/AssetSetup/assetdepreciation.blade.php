@extends('layouts.layout')
@section('pageTitle')
    Asset Depreciation
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Depreciation</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Asset Depreciation</a></li>
         
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
                                    <label class="control-label">Asset Category</label>
                                    <select  class="form-control" name="category" >
                                     <option value="">--All Cateory--</option>
                                          @foreach($AssetCategory as $list)
                                     <option value="{{ $list->id }}" {{ (old('category') == $list->id ||($category) == $list->id  ) ? 'selected':'' }}>{{ $list->category }}</option>
                                          @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Year</label>
                                    <select name="year" class="form-control" id="year"  required>
                                      <option Value="">Select Year</option>
                                         @for ($i = 2018; $i < 2035; $i++)
                                          <option value="{{ $i }}" {{ ($year) == $i ? "selected":"" }}>{{$i}}</option>
                                          @endfor
                                    </select>  
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Month</label>
                                    <select class="form-control" id="month" name="month" onchange="ReloadForm()" required="">
                                       <option value=""  > Choose One</option> 
                                       <option value="January" {{ ($month) == 'January' ? "selected":"" }}  > January</option>     
                                       <option value="February" {{ ($month) == 'February' ? "selected":"" }} > February</option> 
                                       <option value="March" {{ ($month) == 'March' ? "selected":"" }} > March</option> 
                                       <option value="April" {{ ($month) == 'April' ? "selected":"" }} > April</option> 
                                       <option value="May" {{ ($month) == 'May' ? "selected":"" }} > May</option> 
                                       <option value="June" {{ ($month) == 'June' ? "selected":"" }} > June</option> 
                                       <option value="July" {{ ($month) == 'July' ? "selected":"" }} > July</option> 
                                       <option value="August" {{ ($month) == 'August' ? "selected":"" }} > August</option> 
                                       <option value="September" {{ ($month) == 'September' ? "selected":"" }} > September</option> 
                                       <option value="October" {{ ($month) == 'October' ? "selected":"" }} > October</option> 
                                       <option value="November" {{ ($month) == 'November' ? "selected":"" }} > November</option> 
                                       <option value="December" {{ ($month) == 'December' ? "selected":"" }} > December</option> 
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit" name="process">Process</button>
                    </div>
                </form>
                
                <!--===================================================-->
                <!-- End Inline Form  -->

            </div>
        </div>
   
    <!--modal for deleting record-->
    
    </div>
        <!--/// content end here -->
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

    function editfunc(id,manu,brand)
    {
        document.getElementById('id').value = id;
        document.getElementById('manu').value = manu;
        document.getElementById('brand').value = brand;
        
        $("#editModal").modal('show')
    }
   function deletefunc(id)
    {
        document.getElementById('deleteid').value = id;
                     
        $("#deleteModal").modal('show')
    }
    
             
</script>



  
@stop
