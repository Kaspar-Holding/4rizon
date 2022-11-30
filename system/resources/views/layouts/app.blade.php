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
   </head> 
  
   <body class="dashboard dashboard_1">
        <div class="full_container">
            <div class="inner_container">
                @include('navigation')
                <div id="content">
                    @include('header')
                    <div class="midde_cont">
                   
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
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>

      <!-- custom js -->
      <script src="{{ asset('new/js/custom.js')}}"></script>
      <script src="{{ asset('new/js/chart_custom_style1.js')}}"></script>
      
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
</body>
            
</html>
