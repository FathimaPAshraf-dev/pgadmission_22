@extends('layouts.app')

@section('styles')

@stop


@section('scripts')


@stop
@section('tittle')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">PG APPLICATION -2021</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              
<!--              <li class="breadcrumb-item">Desktop</li>-->
              
<!--              <li class="breadcrumb-item">Mobile</li>-->
          
            
<!--              <li class="breadcrumb-item"><a href="#">Home</a></li>-->
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop
@section('content')
<section class="content-header">
    <div class="card card-info">
      <div class="card-header">
                <h3 class="card-title"><b>PG Admission-2021</b></h3>
            </div>  
        <br>@foreach($results as $key)
        <marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>Hi {{$key->pgapp_name}}  </b></p></marquee>
        <marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>upload yournon creamy layer /caste certificate !!!</b></p></marquee>

        @endforeach

    </div>
    
  
    
</section>
 <br>

 <html>
<head>
    <title>Upload Plus two Marklist/Grade sheet</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
</head>
  
<body>
<div class="container">
   
    <div class="panel panel-primary">
      <div class="panel-heading"><h5>Upload Non creamy layer certificate for OBC students </h5></div>
      <div class="panel-heading"><h5>and caste certificate for SC/ST/OEC students </h5></div>
    
      <div class="panel-body">
   
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        
<!--        <img src="public/images/ugcertificates/{{ Session::get('file') }}"width="130" height="160">-->
        
     <div class="form-group row">

 @foreach($results as $key)
 
                <p style="font-size: 17px;"><font style="color: red"><b>View Uploaded Certificate</b> <i class="fa fa-info-circle" style="font-size:20px"></i>
                    <a href="{{ asset('images/pgcertificates/'.$key->pgapp_certificate)}} "></font>
                          <b>Click here</b></a></p> 
                          
                   
  @endforeach
   
     </div>    

        
        
  
        @endif
  
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  
        <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
  
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control">
                </div>
   
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
                
               
                
                
   
            </div>
        </form>
  
      </div>
    </div>
</div>
</body>
  
</html>

    @endsection
