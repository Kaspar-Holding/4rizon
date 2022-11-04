<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Jynx Dashboard Login</title>
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
      <!-- calendar file css -->
      <link rel="stylesheet" href="{{ asset('new/js/semantic.min.css')}}" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page">
      <div class="full_container">
         <div class="container-login">
            <div class="center verticle_center full_height">
               <div class="row" style="width:100%;height:100vh;">
                  <!--<div class="logo_login">-->
                     <!--<div class="center">-->
                     <!--   JYNX DASHBOARD-->
                     <!--</div>-->
                  <!--</div>-->
                  
    
                  <div class=" col-md-7 login_form">
                       
                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     <form method="POST" action="{{ route('update_password') }}" class="login_section">
                        @csrf
                        <h1 class="center login_heading" style="color:#145DBB; font-size:49px; line-height:140%; padding-bottom:40px;">Reset Password</h1>
                        <fieldset>
                           <div class="field" style="margin:0px!important; justify-content:center;">
                             
                              <input  style="background:#e8f0fe!important; color:white !important" type="email" class="login-in" name="email" :value="old('email')" required class="{{ $errors->has('email') ? 'is-invalid' : '' }}"  placeholder="Enter Email" />
                              <x-jet-input-error for="email"></x-jet-input-error>
                           </div>
                           <div class="field" style="justify-content:center;">
                             
                              <input style="background:#e8f0fe!important;" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }} login-in" name="password" required autocomplete="current-password" placeholder="Enter Password" />
                              <x-jet-input-error for="password"></x-jet-input-error>
                           </div>
                          
                           <div class="field margin_0" style="justify-content:center;">
                             
                              <center><button type="submit" class="main_bt">Submit</button></center>
                           </div>
                        </fieldset>
                     </form>
                      
                  </div>
                  <div class="col-md-5 login">
                      <div class="center">
                        <div style="position:absolute; top:20%; text-align:center;"><svg width="170" height="169" viewBox="0 0 170 169" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M84.6216 167.36C130.389 167.36 167.49 130.258 167.49 84.4913C167.49 38.7242 130.389 1.62256 84.6216 1.62256C38.8545 1.62256 1.75293 38.7242 1.75293 84.4913C1.75293 130.258 38.8545 167.36 84.6216 167.36Z" stroke="white" stroke-width="3.17992" stroke-miterlimit="10"/>
                        <path d="M89.1848 83.0761C89.1848 83.6167 89.1848 83.9983 89.1848 84.3957V93.379C89.1848 94.81 88.7396 95.2711 87.3404 95.287C84.0651 95.287 84.0492 95.287 84.0651 92.2342C84.0651 87.0033 84.0651 81.7882 84.0651 76.5572C83.9971 76.0908 84.0738 75.6147 84.2848 75.1932C84.4957 74.7716 84.8308 74.4249 85.2449 74.1996C85.659 73.9744 86.1321 73.8815 86.6006 73.9335C87.0691 73.9855 87.5104 74.1798 87.8651 74.4903C89.1306 75.4531 90.3164 76.5165 91.4107 77.6702C94.066 80.2777 96.6894 82.9171 99.3605 85.5246C99.5513 85.7154 99.758 85.8585 100.156 86.1765V75.8894C100.156 74.2995 100.521 74.0133 102.048 73.9815C105.53 73.9815 105.227 73.9815 105.227 77.1614C105.227 82.3977 105.227 87.6234 105.227 92.8384C105.227 93.8401 105.053 94.81 104.114 95.2393C103.656 95.466 103.138 95.5434 102.633 95.4607C102.129 95.378 101.662 95.1393 101.3 94.7782C99.3923 93.0133 97.5162 91.1849 95.6559 89.3564L89.1848 83.0761Z" fill="white"/>
                        <path d="M125.96 84.7299L131.764 90.6605C132.654 91.5667 133.576 92.4412 134.435 93.3793C134.657 93.6337 134.88 94.1584 134.769 94.381C134.657 94.6036 134.117 95.2714 133.719 95.3032C132.497 95.4937 131.253 95.4937 130.031 95.3032C129.081 95.0412 128.215 94.5372 127.519 93.8404C125.738 92.2504 124.052 90.5015 122.303 88.7843L118.901 92.1391C118.09 92.9341 117.311 93.8404 116.484 94.54C115.927 94.942 115.275 95.1939 114.592 95.2714C113.535 95.3801 112.469 95.3801 111.412 95.2714C110.983 95.2714 110.299 94.9534 110.236 94.6672C110.172 94.3938 110.169 94.1099 110.227 93.8352C110.284 93.5606 110.401 93.3018 110.57 93.0772C112.16 91.3601 113.749 89.7065 115.451 88.0212C116.389 87.0672 117.311 86.0973 118.297 85.1751C118.806 84.714 118.71 84.4119 118.297 83.9668C115.785 81.4228 113.278 78.863 110.776 76.2872C110.347 75.858 109.743 75.4605 110.077 74.6973C110.411 73.9341 111.11 74.0454 111.762 73.9182C112.993 73.6347 114.281 73.7357 115.452 74.2077C116.624 74.6798 117.622 75.4999 118.313 76.5575C119.393 77.7425 120.562 78.8428 121.811 79.8488C121.876 79.9439 121.964 80.0216 122.067 80.0753C122.169 80.129 122.283 80.157 122.399 80.157C122.515 80.157 122.628 80.129 122.731 80.0753C122.833 80.0216 122.921 79.9439 122.987 79.8488C124.482 78.3701 126.056 76.955 127.503 75.4128C127.934 74.8753 128.489 74.45 129.12 74.1732C129.751 73.8963 130.44 73.7761 131.128 73.8228C131.93 73.8225 132.732 73.8702 133.529 73.9659C134.016 74.0997 134.436 74.4118 134.705 74.8404C134.832 75.0312 134.562 75.6354 134.308 75.9056C131.668 78.6563 128.997 81.3751 126.358 84.1098L125.96 84.7299Z" fill="white"/>
                        <path d="M47.8773 80.8819C47.8773 79.0376 47.8773 77.1932 47.8773 75.3648C47.8773 73.9338 48.4179 73.4727 49.8489 73.4727C50.4531 73.4727 51.0573 73.4727 51.6615 73.4727C51.8469 73.4639 52.0322 73.4934 52.2057 73.5594C52.3793 73.6254 52.5374 73.7265 52.6702 73.8562C52.8029 73.986 52.9075 74.1418 52.9775 74.3138C53.0474 74.4858 53.0811 74.6704 53.0765 74.856C53.0765 79.0694 53.1719 83.2987 52.9016 87.5757C52.8693 89.4347 52.1494 91.2159 50.8809 92.5754C49.6125 93.9349 47.8854 94.7763 46.033 94.9372C42.5033 95.3824 38.8941 95.3028 35.3326 95.43C34.6966 95.43 34.4263 95.0803 34.4263 94.4761C34.4263 93.3949 34.4263 92.3296 34.4263 91.2962C34.4263 90.2627 34.9828 90.3263 35.6505 90.3263C37.797 90.3263 39.9275 90.3263 42.0104 90.3263C43.0114 90.2952 44.0071 90.1674 44.9836 89.9447C45.7281 89.8502 46.4107 89.482 46.8986 88.9119C47.3865 88.3417 47.6447 87.6103 47.6229 86.8602C47.6229 84.9204 47.6229 82.9807 47.6229 81.0409L47.8773 80.8819Z" fill="white"/>
                        <path d="M63.8727 77.4793L68.2769 83.1077C69.1672 81.9152 69.9781 80.8341 70.7731 79.737C71.8861 78.147 73.015 76.5571 74.0961 75.0784C74.2949 74.7464 74.5849 74.4784 74.9316 74.3064C75.2783 74.1345 75.6671 74.0658 76.0518 74.1085C76.9421 74.1085 77.8643 74.1085 78.7547 74.1085C79.0055 74.1201 79.2511 74.184 79.4757 74.2963C79.7002 74.4086 79.8988 74.5667 80.0585 74.7604C80.1242 74.9994 80.1369 75.2499 80.0957 75.4943C80.0545 75.7388 79.9604 75.9712 79.82 76.1755C77.1329 79.8483 74.3664 83.4734 71.7112 87.1621C71.2073 87.9345 70.9015 88.8192 70.8208 89.7379C70.6777 91.0575 70.8208 92.409 70.8208 93.7445C70.8208 95.0801 70.3438 95.3345 69.2308 95.3345C68.5948 95.3345 67.9589 95.3345 67.3229 95.3345C66.2258 95.3345 65.7329 94.8098 65.7329 93.7445C65.7329 92.6793 65.7329 91.137 65.7329 89.8333C65.7834 88.8603 65.4719 87.9031 64.8584 87.1462C63.6024 85.5563 62.4099 83.9663 61.1539 82.3763C61.0685 82.2988 61.0003 82.2043 60.9536 82.0989C60.9069 81.9935 60.8828 81.8795 60.8828 81.7642C60.8828 81.6489 60.9069 81.5349 60.9536 81.4295C61.0003 81.3241 61.0685 81.2296 61.1539 81.1521C62.0124 79.9278 62.8869 78.7194 63.8727 77.4793Z" fill="white"/>
                        <path d="M58.8006 73.5047C59.3743 73.5079 59.9341 73.6816 60.4088 74.0036C60.8835 74.3256 61.2519 74.7815 61.467 75.3133C61.6821 75.8451 61.7342 76.4289 61.6169 76.9904C61.4995 77.5519 61.2179 78.0659 60.8078 78.467C60.3977 78.8682 59.8776 79.1383 59.3136 79.2433C58.7497 79.3482 58.1672 79.2831 57.6403 79.0563C57.1134 78.8295 56.6658 78.4512 56.3543 77.9695C56.0428 77.4877 55.8816 76.9243 55.891 76.3507C55.9036 75.5888 56.2162 74.8626 56.7609 74.3297C57.3057 73.7968 58.0386 73.5004 58.8006 73.5047V73.5047Z" fill="white"/>
                        </svg>
                        <div style="padding-top:70px; text-align:center;">
                            <svg  style="width:130px;" width="192" height="50" viewBox="0 0 192 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M30.2885 11.962V46.36H21.9095V32.199H8.8755V46.36H0.496496V11.962H8.8755V25.437H21.9095V11.962H30.2885ZM62.1113 32.248C62.1113 33.032 62.0623 33.8486 61.9643 34.698H43.0013C43.132 36.3966 43.671 37.7033 44.6183 38.618C45.5983 39.5 46.7907 39.941 48.1953 39.941C50.286 39.941 51.7397 39.059 52.5563 37.295H61.4743C61.017 39.0916 60.184 40.7086 58.9753 42.146C57.7993 43.5833 56.313 44.7103 54.5163 45.527C52.7197 46.3436 50.7107 46.752 48.4893 46.752C45.8107 46.752 43.426 46.1803 41.3353 45.037C39.2446 43.8936 37.6113 42.2603 36.4353 40.137C35.2593 38.0136 34.6713 35.531 34.6713 32.689C34.6713 29.847 35.243 27.3643 36.3863 25.241C37.5623 23.1176 39.1957 21.4843 41.2863 20.341C43.377 19.1976 45.778 18.626 48.4893 18.626C51.1353 18.626 53.4873 19.1813 55.5453 20.292C57.6033 21.4026 59.204 22.987 60.3473 25.045C61.5233 27.103 62.1113 29.504 62.1113 32.248ZM53.5363 30.043C53.5363 28.6056 53.0463 27.4623 52.0663 26.613C51.0863 25.7636 49.8613 25.339 48.3913 25.339C46.9867 25.339 45.7943 25.7473 44.8143 26.564C43.867 27.3806 43.279 28.5403 43.0503 30.043H53.5363ZM74.9107 10.1V46.36H66.5317V10.1H74.9107ZM89.3618 10.1V46.36H80.9828V10.1H89.3618ZM107.88 46.752C105.201 46.752 102.784 46.1803 100.628 45.037C98.5047 43.8936 96.8223 42.2603 95.581 40.137C94.3723 38.0136 93.768 35.531 93.768 32.689C93.768 29.8796 94.3887 27.4133 95.63 25.29C96.8713 23.134 98.57 21.4843 100.726 20.341C102.882 19.1976 105.299 18.626 107.978 18.626C110.657 18.626 113.074 19.1976 115.23 20.341C117.386 21.4843 119.085 23.134 120.326 25.29C121.567 27.4133 122.188 29.8796 122.188 32.689C122.188 35.4983 121.551 37.981 120.277 40.137C119.036 42.2603 117.321 43.8936 115.132 45.037C112.976 46.1803 110.559 46.752 107.88 46.752ZM107.88 39.5C109.481 39.5 110.836 38.912 111.947 37.736C113.09 36.56 113.662 34.8776 113.662 32.689C113.662 30.5003 113.107 28.818 111.996 27.642C110.918 26.466 109.579 25.878 107.978 25.878C106.345 25.878 104.989 26.466 103.911 27.642C102.833 28.7853 102.294 30.4676 102.294 32.689C102.294 34.8776 102.817 36.56 103.862 37.736C104.94 38.912 106.279 39.5 107.88 39.5ZM137.658 10.737L136.678 34.208H129.573L128.593 10.737H137.658ZM133.248 46.752C131.778 46.752 130.57 46.3273 129.622 45.478C128.708 44.596 128.25 43.518 128.25 42.244C128.25 40.9373 128.708 39.843 129.622 38.961C130.57 38.079 131.778 37.638 133.248 37.638C134.686 37.638 135.862 38.079 136.776 38.961C137.724 39.843 138.197 40.9373 138.197 42.244C138.197 43.518 137.724 44.596 136.776 45.478C135.862 46.3273 134.686 46.752 133.248 46.752Z" fill="white"/>
                            <path d="M142.784 49.79H191.784V0.78997H142.784V49.79Z" fill="url(#pattern0)"/>
                            <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_206_36" transform="scale(0.015625)"/>
                            </pattern>
                            <image id="image0_206_36" width="64" height="64" xlink:href="data:image/png;base64,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"/>
                            </defs>
                            </svg>
                            
                        </div>
                        
                        </div>
                      </div>
                  </div>
                  </div>
                   
                 
               </div>
               
               
         
            
         </div>
      </div>
      <!-- jQuery -->
      <script src="{{ asset('js/jquery.min.js')}}"></script>
      <script src="{{ asset('js/popper.min.js')}}"></script>
      <script src="{{ asset('js/bootstrap.min.js')}}"></script>
      <!-- wow animation -->
      <script src="{{ asset('js/animate.js')}}"></script>
      <!-- select country -->
      <script src="{{ asset('js/bootstrap-select.js')}}"></script>
      <!-- nice scrollbar -->
      <script src="{{ asset('js/perfect-scrollbar.min.js')}}"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="{{ asset('js/custom.js')}}"></script>
   </body>
</html>
