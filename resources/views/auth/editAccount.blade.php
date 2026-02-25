@extends('layouts.layout')
@section('pageTitle')
    Edit Profile
@endsection

@section('pageHead')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Edit Profile</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Edit  Profile</li>
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
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Profile</h3>
                </div>
                <div class="panel-body">
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

                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Success!</strong>
                            {{ session('msg') }}
                        </div>
                    @endif

                    @if(session('err'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Not Allowed ! </strong>
                            {{ session('err') }}
                        </div>
                     @endif

                <!-- Inline Form  -->
                    <!--===================================================-->
                     <form method="post" action="{{ url('/user/editAccount') }}">

  
            {{ csrf_field() }}
            
            
            <div class="panel-body"><!--2nd col-->
                                <div class="row">
                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="userName">Full name</label>
                                           <input type="Text" name="fullName" class="form-control" value="{{ Auth::user()->name }}">
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="userName">User Name</label>
                                          <input type="Text" name="userName" class="form-control" value="{{ Auth::user()->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="userName">User Role</label>
                                          <input type="Text" name="userName" class="form-control" value="{{ $userrole }}" readonly>
                                        </div>
                                    </div>
                                 
                                </div>
                                
                                <div class="row">
                                 <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="division">Password</label>
                                          <input type="password" name="password" class="form-control">
                                        </div>
                                  </div>  
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="password">Confirm Password</label>
                                          <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <div align="right">
                                                <button class="btn btn-success" type="submit"> Save Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
        </div><!-- /.col -->
    </div><!-- /.row -->
  </form>
                    <!--===================================================-->
                    <!-- End Inline Form  -->

                </div>
            </div>

        </div>
        <!--/// content end here -->
    </div>
    </div>

@endsection
