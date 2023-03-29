@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show fade-in-text" role="alert">
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close" style = "background-color:#bfbfd3;"><i class="fa fa-minus"></i></button>   
    {{ $message }}
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close" style = "background-color:#bfbfd3;"><i class="fa fa-minus"></i></button>    
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close" style = "background-color:#bfbfd3;"><i class="fa fa-minus"></i></button>    
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close" style = "background-color:#bfbfd3;"><i class="fa fa-minus"></i></button>    
    <strong>{{ $message }}</strong>
</div>
@endif
  
@if ($errors->any())
<div class="alert alert-danger">
<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close" style = "background-color:#bfbfd3;"><i class="fa fa-minus"></i></button>   
    Please check the form below for errors
</div>
@endif