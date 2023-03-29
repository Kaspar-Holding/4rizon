<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Tue Nov 08 2022 19:02:03 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="63645b88c2fba96c8ea60539" data-wf-site="636417981c03ca1b09a84b12">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
  <meta content="Contact Us" property="og:title">
  <meta content="Contact Us" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="new/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="new/css/webflow.css" rel="stylesheet" type="text/css">
  <link href="new/css/4rizon.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="new/css/contactus.css">
  <link rel="stylesheet" type="text/css" href="intl-tel-input/build/css/intlTelInput.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({ google: {    families: ["Mulish:300,regular,500,600,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon-32x32.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <style>
/* Google Font CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
.row {
  display: flex;
}

.column {
  flex: 50%;
}
/* .container1{
  min-height: 100vh;
  width: 100%;
  background: #c8e8e9;
  display: flex;
  align-items: center;
  justify-content: center;
} */
.container1{
  width: 85%;
  background: #fff;
  border-radius: 6px;
  max-width: 900px;
  margin-top: 40px;
  padding : 0px;
  margin-left: 200px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.container1 .content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.container1 .content .left-side{
  width: 25%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  position: relative;
}
.content .left-side::before{
  content: '';
  position: absolute;
  height: 70%;
  width: 2px;
  right: -15px;
  top: 50%;
  transform: translateY(-50%);
  background: #afafb6;
}
.content .left-side .details{
  margin: 14px;
  text-align: center;
}
.content .left-side .details i{
  font-size: 30px;
  color: #3e2093;
  margin-bottom: 10px;
}
.content .left-side .details .topic{
  font-size: 18px;
  font-weight: 500;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two{
  font-size: 14px;
  color: #afafb6;
}
.container1 .content .right-side{
  width: 75%;
  margin-left: 75px;
}
.content .right-side .topic-text{
  font-size: 23px;
  margin-top: 10px;
  margin-bottom: 13px;
  font-weight: 600;
  color: #3e2093;
}
.right-side .input-box{
  height: 50px;
  width: 100%;
  margin: 12px 0;
}
.right-side .input-box input,
.right-side .input-box textarea{
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  font-size: 16px;
  background: #F0F1F8;
  border-radius: 6px;
  padding: 0 15px;
  resize: none;
}
.right-side .message-box{
  min-height: 110px;
}
.right-side .input-box textarea{
  padding-top: 6px;
}
.right-side .button{
  display: inline-block;
  margin-top: 12px;
  
}
.right-side .button input[type="button"]{
  color: #fff;
  font-size: 18px;
  outline: none;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  background: #3e2093;
  cursor: pointer;
  transition: all 0.3s ease;
}
.button input[type="button"]:hover{
  background: #5029bc;
}

@media (max-width: 950px) {
  .container1{
    width: 90%;
    padding: 30px 40px 40px 35px ;
  }
  .container1 .content .right-side{
   width: 75%;
   margin-left: 55px;
}
}
@media (max-width: 820px) {
  .container1{
    margin-top: 40px;
    margin-left:20px;
    margin-right:20px;
    height: 100%;
  }
  .container1 .content{
    flex-direction: column-reverse;
  }
 .container1 .content .left-side{
   width: 100%;
   flex-direction: row;
   margin-top: 40px;
   justify-content: center;
   flex-wrap: wrap;
 }
 .container1 .content .left-side::before{
   display: none;
 }
 .container1 .content .right-side{
   width: 100%;
   margin-left: 0;
 }
}
@media(min-width: 1440px){
.container-5 {
    padding-top: 215px !important;
    padding-bottom: 123px;
}
}
@media(min-width: 375px){
form {
    margin-left : 20px !important;
}
.button{
  margin-left : 30px !important;
}
}
@media(min-width: 320px){
form {
    margin-left : 0px !important;
}
.button{
  margin-left : 30px !important;
}
}
.nav-menu-2{
  font-size: medium;
    font-weight: bold;
}
.form-group{
  padding : 10px;
  width : 300px !important;
}
.brand {
    position: relative;
    left: 8%;
    bottom: 8px;
    text-align: justify;
}
.nav-menu{
  padding:0%;
  background-color: black;
  margin-top: 60px;
  margin-right:110px;

}
.w-container {
    margin-left: auto;
    margin-right: auto;
    max-width: 1205px !important;
}
.right-side .input-box input, .right-side .input-box textarea {
    height: 82% !important;
    width: 38% !important;
    border: none;
    outline: none;
    font-size: 16px;
    background: #F0F1F8;
    border-radius: 6px;
    padding: 0 15px;
    resize: none;
}
    </style>
</head>
<body class="body-4">
  <div class="contact wf-section" style = "height: 800px;">
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar-2 w-nav">
        <div class="">
            <a href="#" class="w-nav-brand brand"><img src="images/LOGO-01-1.svg" loading="lazy" alt="" class="image-6" style="    margin-left: 0px; filter: contrast(6.5);"></a>
            <nav role="navigation" class="nav-menu w-nav-menu" style="font-weight:bold;">
            <a href="{{ route('homepage') }}" aria-current="page" class="nav-link w-nav-link">Home</a>
            <a href="{{ route('event-page') }}" class="nav-link-2 w-nav-link">Events</a>
            <a href="{{ route('gallery1') }}" class="nav-link-2 w-nav-link">Gallery</a>
            <a href="{{ route('about-us') }}" class="nav-link-2 w-nav-link">About Us</a>
            <a href="{{ route('contact-us') }}" class="nav-link-3 w-nav-link">Contact Us</a>
            <a href="{{ route('register') }}" class="nav-link-3 w-nav-link w--current">Register</a>

            <a href="{{ route('book-event') }}" class="nav-link-3 button w-nav-link" style="background: transparent;padding:10.5px;">Book Event</a>
            </nav>
            <div class="menu-button-2 w-nav-button">
            <div class="w-icon-nav-menu"></div>
            </div>
        </div>
        <div class="container-5 w-container">
            <div class="row" style = "margin-left:30px; margin-top:200px;">
                <div class="column">
                
                      
                        <form method="POST" encrypt="multipart/form-data" action="/web_email_verify" style = "margin-top: 100px; margin-left: 100px;">
                            @csrf
                            <div class="form-group">
                                <input style = " width : 250px !important; padding : 7px; border-radius : 10px;" type="text" name="otp" placeholder="Enter your otp" required>
                                {{-- <<input style = "width : 250px !important; padding : 7px; border-radius : 10px;" type="hidden" name="email" value = "{{$email}}" hidden> --}}
                            </div>
                            @if(session()->has('error'))
                            <div class="alert alert-danger" style = "color: #f7073f;">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                            <div class="button">
                                <input type="submit" class="button w-button" value="Send Now" style="margin-left: 100px; margin-bottom : 10px; padding-right: 30px padding-left: 30px; border-radius: 16px;">
                            </div>
                        </form>
                        <a style = "padding-left : 80px" href="{!! route('resend_otp', ['email'=>$email]) !!}">Resend otp</a>
                    </div>
              

                
        
             
            </div>
        </div>
      
    </div>
  </div>
</div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=636417981c03ca1b09a84b12" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="new/js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
<script>
  var input = document.querySelector("#phone"),
  errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// initialise plugin
var iti = window.intlTelInput(input, {
  utilsScript: "../../build/js/utils.js?1638200991544"
});

var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
</script>
</html>