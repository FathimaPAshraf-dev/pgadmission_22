@extends('layouts.app')

@section('styles')

@stop


@section('scripts')
 <script type="text/javascript">
     $(document).ready(function (){
              
   $("#successMessage").delay(5000).slideUp(400);
    $('.examhome').removeClass('active');
    $('.examhome').addClass('active');
 
   

});
</script>
 
@stop

@section('content')
 <section class="content">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
    
 <div class="card card-info card-outline">
       <div class="form-horizontal">
            
            <div class="card-header with-border" style="text-align: center;">
                <h4>PG ADMISSION : STUDY CAMPUS OPTION ENTRY<BR></h4>
            </div>
        <form class="form-horizontal" name="formpgapp" id="formpgapp"  method="" >
            <div class="card-body">
                  <h5 style="color: red; text-align: center">You are not included in the rank list. Please check the rank list</h5>
                  
            </div>
        </form>

    </div>
</div>
         
    </div>
</div>
    </div>
 </section>
@endsection
