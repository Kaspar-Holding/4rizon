
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
    
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>4RIZON Dashboard</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="{{ asset('new/images/fevicon.png')}}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('new/css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{ asset('new/style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{ asset('new/css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{ asset('new/css/colors.css')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{ asset('new/css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{ asset('new/css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{ asset('new/css/custom.css')}}" />
      <link rel="stylesheet" href="{{ asset('new/css/select2.min.css')}}" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
      <link rel="stylesheet" href=" https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js" type="text/css" media="all">
      <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
      <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
      <style>
         .dataTables_wrapper .dataTables_filter input {
        border-radius: 11px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: aliceblue !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_pag{
        color: aliceblue !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: aliceblue !important;
    }
    .dataTables_wrapper .dataTables_length select {
    /* border: 1px solid #aaa; */
    border-radius: 20px !important;
    color: cornflowerblue !important;
    }
    .timeCss{
  background: rgb(13 45 80);
  border-radius: 5px;
  padding: 9px;
  color:rgb(69 161 243 / 54%);
}
.hidee{
            display:none;
        }
        </style>
   </head> 
  
   <body class="dashboard dashboard_1">
        <div class="full_container">
            <div class="inner_container">
                @include('navigation')
                <div id="content">
                    @include('header')
                    <div class="midde_cont">
                        <a href="{{ URL::previous() }}" style = "color : aliceblue; background : transparent; border-color: transparent;" class="btn btn-warning"> <i class="fa fa-angle-double-left"></i> Back</a>
                        @yield('content')
                        
                    </div>
                    
                    <!-- Footer -->    
                </div>
            </div>
        </div>
            <!-- Scroll to top -->
        <script src="{{ asset('new/js/jquery.min.js')}}"></script>
      <script src="{{ asset('new/js/popper.min.js')}}"></script>
      <script src="{{ asset('new/js/bootstrap.min.js')}}"></script>
      <!-- wow animation -->
      <script src="{{ asset('new/js/animate.js')}}"></script>
      <!-- select country -->
      <script src="{{ asset('new/js/bootstrap-select.js')}}"></script>
      <!-- owl carousel -->
      <script src="{{ asset('new/js/owl.carousel.js')}}"></script> 
      <!-- chart js -->
      <!-- <script src="{{ asset('new/js/Chart.min.js')}}"></script> -->
      <!-- <script src="{{ asset('new/js/Chart.bundle.min.js')}}"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="{{ asset('new/js/select2.full.min.js')}}"></script>
      <script src="{{ asset('new/js/utils.js')}}"></script>
      <!-- <script src="{{ asset('new/js/analyser.js')}}"></script> -->
      <!-- nice scrollbar -->
      <script src="{{ asset('new/js/perfect-scrollbar.min.js')}}"></script>
    
      
      <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
    
      <!-- custom js -->
      <script src="{{ asset('new/js/custom.js')}}"></script>
      <script src="{{ asset('new/js/chart_custom_style1.js')}}"></script>
      {{-- <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(function(){
            $(".alert").remove();
            }, 9000 ); // 5 secs
        });
      </script> --}}
      <script type="text/javascript">
        $(document).ready(function (){
          $('.btn-copy').click(function (){
            $('.example-2').append($('.example-2').html())            
          })
        })
      </script>
      <script type="text/javascript">
        $('#category_id').on('change', function() {
            var category_id =  this.value;
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: 'get_category_detail',
                type: 'post',
                data: {category_id:category_id, _token: '{{csrf_token()}}'},
                success:function(data){
                  if (data.category == "Vouchers") {
                    $('#voucher').show();
                  }
                }
            });
        });
        $(document).ready(function() {
            $(".select_group").select2();
            
        });
        $(document).ready(function () {
            $(".addmore").click(function () {
                // var cloneIndex = $(".abcd").length;
                // $(".abcd:last").clone().appendTo(".clonedata");
                // console.log(cloneIndex);
                // if (cloneIndex > 0){
                //     $('.abcd:last').find('.checks').attr("value", ' ');
                //     $('.abcd:last').find('.htmls').attr("value", cloneIndex);
                // }
                $(".abcd")
                  .eq(0)
                  .clone()
                  .find("input").val("").end() // ***
                  .show()
                  .insertAfter(".abcd:last");
            });
            $(".clonedata").on('click', '.removemore', function () {
                var $tr = $(this).closest('.abcd');
                if ($tr.index() > 0){
                    $(".abcd:last").remove();
                }
            });
        });
      </script>
        <script>
            $(function(){
                var dtToday = new Date();
                
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();
                
                var maxDate = year + '-' + month + '-' + day;
            
                // or instead:
                // var maxDate = dtToday.toISOString().substr(0, 10);
                $('#txtDate').attr('min', maxDate);
            });
        </script>
        <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
     
        } );
        </script>
        <script>
            function exportTasks(_this) {
               let _url = $(_this).data('href');
               window.location.href = _url;
            }
         </script>
         <script>
	$(document).ready(function() {
		$('.select2[multiple]').select2({
    width: '100%',
    closeOnSelect: false
})

    
});
	</script>
    <script>
    $('#selectAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});

      </script>
     <script>
        $('#deleteAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });
    
          </script>
    <script>
        $('.users').on('change',function(){
    var value = $(this).val();
    location.href = value; //or .php, etc. This will go to a page called en.html
    });
    </script>
    <script>
        $(document).ready(function() {
            $('dropdown-menu.mega-dropdown-menu').on('click', function (event) {
                event.stopPropogation();
            });
        });
      
        </script>
    <script>
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#ele a[href="' + activeTab + '"]').tab('show');
        }
    });
     </script> 
     <script>
     $("document").ready(function(){
        setTimeout(function(){
        $("div.alerti").remove();
        }, 2000 ); // 2 secs

    });
     </script> 
      <script>
        $("document").ready(function(){
           setTimeout(function(){
           $("div.alertii").remove();
           }, 10000 ); // 2 secs
   
       });
        </script> 
     <script>   
                $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
            })
</script> 
<script>   
    $('#myModal').on('shown.bs.modal', function () {
$('#myInput').trigger('focus')
})
</script> 
<script> 
$('#multiconfirm-modal').on('show.bs.modal', function(e) {
    // debugger;
    var checkedValues = $('.record:checked').map(function(){ return this.value; }).get();
   
    //put the ids in the hidden input as a comma separated string
    $('#hidden_checkedinput').val(checkedValues.join(','));
  });
</script> 
<script> 
    $('#multiconfirm-modal1').on('show.bs.modal', function(e) {
        // debugger;
       
        var checkedValues = $('.record1:checked').map(function(){ return this.value; }).get();
    //    alert(checkedValues);
        //put the ids in the hidden input as a comma separated string
        $('#hidden_checkedinput1').val(checkedValues.join(','));
      });
    </script>


<script type="text/javascript">
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;

        // or instead:
        // var maxDate = dtToday.toISOString().substr(0, 10);

     
        $('#event_date').attr('min', maxDate);
    });
</script>


<script type="text/javascript">
 window.addEventListener('click', function(e){
    if (document.getElementById('submit').contains(e.target)){
        e.preventDefault();
        var data=$('#dj_form').serialize();
        console.log($("#dj_form").serialize());
        $.ajax({
            url:"{{url('api/dj_time_allocation')}}",
            type:'post',
            data:data,
            success:function(response){
                console.log(response);
                
                    $('#timeslot').append("<p>"+response.time+"</p>");
                
                $.each(response.artist1, function (key, value) {
                    $('#d1').append("<p>"+value.first_name+" "+value.last_name+"</p>");
                })
                $.each(response.artist2, function (key, value) {
                    $('#d2').append("<p>"+value.first_name+" "+value.last_name+"</p>");
                })
                $.each(response.artist3, function (key, value) {
                    $('#d3').append("<p>"+value.first_name+" "+value.last_name+"</p>");
                    
                })
                $('#delete').append("<a href='/delete_timeslot/"+response.info+"' class='btn btn-primary'>Delete</a>");
            }
        }); 
        
    } 
})
</script>
<script>var jQuery132 = $.noConflict(true);</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       // Save data
       $(".txtedit").focusout(function(){
           var data=$('#user_form').serialize();
           var dataJSON = JSON.stringify(data);
           console.log(data);
           $.ajax({
               url:"{{url('api/showData')}}",
               type:'post',
               data:data,
               success:function(response){
              
                   console.log(response);
               }
       });
       });
   
   });
</script>
	</body>
</body>
            
</html>
