<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Tue Nov 08 2022 19:02:03 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="63693bd05b56698c6ba7dd61" data-wf-site="636417981c03ca1b09a84b12">
<head>
  <meta charset="utf-8">
  <title>Gallery</title>
  <meta content="Gallery" property="og:title">
  <meta content="Gallery" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="new/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="new/css/webflow.css" rel="stylesheet" type="text/css">
  <link href="new/css/4rizon.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Mulish:300,regular,500,600,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon-32x32.png" rel="shortcut icon" type="image/x-icon">
  <style>
.nav-menu-2{
  font-size: medium;
    font-weight: bold;
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
#navbar {
  overflow: hidden;
  /* background-color: #333; */
}

/* Navbar links */
#navbar a {
  float: left;
  display: block;
  
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

/* Page content */
.content {
  padding: 16px;
}

/* The sticky class is added to the navbar with JS when it reaches its scroll position */
.sticky {
  position: fixed;
    top: -40px;
    width: 45%;
    right: 95px;
}

/* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
  padding-top: 60px;
}
.button{
  margin-top : 0px !important;
}
    </style>
</head>
<body class="body-5">
  <div class="main-section wf-section">
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" data-doc-height="1" role="banner" class="navbar-2 w-nav">
      <div class="">
        <a href="#" class="w-nav-brand brand"><img src="images/LOGO-01-1.svg" loading="lazy" alt="" class="image-6" style=" margin-left: 0px; filter: contrast(6.5);"></a>
        <nav role="navigation" id = "navbar" class="nav-menu w-nav-menu" style="font-weight:bold;">
          <a href="{{ route('homepage') }}" aria-current="page" class="nav-link w-nav-link">Home</a>
          <a href="{{ route('event-page') }}" class="nav-link-2 w-nav-link">Events</a>
          <a href="{{ route('gallery1') }}" class="nav-link-2 w-nav-link w--current">Gallery</a>
          <a href="{{ route('about-us') }}" class="nav-link-2 w-nav-link">About Us</a>
          <a href="{{ route('contact-us') }}" class="nav-link-3 w-nav-link">Contact Us</a>
          <a href="{{ route('register') }}" class="nav-link-3 w-nav-link">Register</a>
          <a href="{{ route('book-event') }}" class="nav-link-3 button w-nav-link">Book Event</a>
        </nav>
        <div class="menu-button-2 w-nav-button">
          <div class="icon w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
    <div class="container-5 w-container">
      <div>
        <h1 class="heading-15">Gallery</h1>
      </div>
    </div>
  </div>
  <div class="wf-section">
    <div class="container-11 w-container">
      <div>
        {{-- <div class="w-layout-grid grid-22">
          <div id="w-node-b0a36f6a-a972-b028-146e-a98fced0cec7-6ba7dd61"><a target="_blank" href="images/pexels-photo-8112583-1-1.png"><img src="images/pexels-photo-8112583-1-1.png" loading="lazy" id="w-node-f0f8c76d-f184-ed8f-fd4d-9878aa363d02-6ba7dd61" alt=""></a></div>
          <div id="w-node-_5e5ef061-e800-342c-81bc-646780b6ac0f-6ba7dd61" class="div-block-37"><a target="_blank" href="images/2.webp"><img src="images/2.webp" loading="lazy" srcset="images/2-p-500.webp 500w, images/2-p-800.webp 800w, images/2-p-1080.webp 1080w, images/2.webp 1188w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-10"></a></div>
          <div id="w-node-c0b233a5-5e5d-f360-12cd-d04e0f09e1d8-6ba7dd61"><a target="_blank" href="images/16.webp"><img src="images/16.webp" loading="lazy" srcset="images/13-p-500.webp 500w, images/13-p-800.webp 800w, images/13-p-1080.webp 1080w, images/16.webp 1288w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-11"></a></div>
        </div>
        <div id="w-node-_90eb2804-50ca-06f3-53cf-9d275d70ed6c-6ba7dd61" class="w-layout-grid grid-23">
          <div id="w-node-ea805919-ca58-6933-0af1-8d0beddf0453-6ba7dd61"><a target="_blank" href="images/pexels-photo-9005430-2.png"><img src="images/pexels-photo-9005430-2.png" loading="lazy" srcset="images/pexels-photo-9005430-2-p-500.png 500w, images/pexels-photo-9005430-2.png 504w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-12"></a></div>
          <div id="w-node-_9e9371a0-3648-c36d-a727-155e7f822178-6ba7dd61" class="w-layout-grid grid-24">
            <div id="w-node-ff11b908-8c99-6516-9a7b-64951d0286f4-6ba7dd61"><a target="_blank" href="images/pexels-photo-7715460-2.png"><img src="images/pexels-photo-7715460-2.png" loading="lazy" alt=""></a></div>
            <div id="w-node-dbcacc28-f4d9-7687-d9b0-c8593d7ad1b4-6ba7dd61"><a target="_blank" href="images/pexels-photo-2350325-1.png"><img src="images/pexels-photo-2350325-1.png" loading="lazy" id="w-node-ce36beea-55ad-afdf-2458-fe4fb6b9c62e-6ba7dd61" alt=""></a></div>
            <div id="w-node-_1fdb28d4-14cb-20c5-b379-37779d056e37-6ba7dd61"><a target="_blank" href="images/19.webp"><img src="images/19.webp" loading="lazy" id="w-node-_0269e8cf-cd87-91e9-e061-48d06b5685e5-6ba7dd61" srcset="images/19-p-500.webp 500w, images/19-p-800.webp 800w, images/19-p-1080.webp 1080w, images/19.webp 1166w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt=""></a></div>
          </div>
        </div> --}}
        <div class="w-layout-grid grid-22" style="margin-top:1rem;">
        @foreach($gallery as $images)
        <div><a target="_blank"><img src="image/{{$images['image']}}" loading="lazy" alt=""></a></div>
        @endforeach
        
         
        </div>
      </div>
      {{-- <div class="div-block-38">
        <a href="#" class="button w-button">Load More</a>
      </div> --}}
    </div>
  </div>
  <div class="footer-section wf-section">
    <div class="container-4 w-container">
      <div class="div-block-17">
        <div class="w-layout-grid grid-10">
          <div id="w-node-_02d47209-7f69-f6ac-efb3-10ae17829d7e-b5a84b13" class="div-block-20">
            <p class="paragraph-5">A totally new nightlife immersive experience with the best DJs and Specialists. Now is the ideal time to take your entertainment to a higher level.</p>
          </div>
          <div id="w-node-ea50531f-4263-c568-cc49-6f7a1024e3f9-b5a84b13">
            <h1 class="heading-10">Contact Us</h1>
            <div class="w-layout-grid grid-11">
              <div id="w-node-d79204e9-6a71-909b-8b63-070778ed3dc7-b5a84b13"><img src="images/icon-03.webp" loading="lazy" width="696" id="w-node-ef6687b5-37ed-2755-78d5-5bfb4e29f9eb-b5a84b13" sizes="(max-width: 479px) 57vw, (max-width: 767px) 91vw, 695.9942626953125px" srcset="images/icon-03-p-500.webp 500w, images/icon-03-p-800.webp 800w, images/icon-03.webp 1392w" alt="" class="image-2"></div>
              <div id="w-node-_282152f2-4872-b5c6-4a38-e615f5c1a003-b5a84b13">
                <h6 class="heading-11">Fourways, Johannesburg</h6>
              </div>
              <div id="w-node-_40c5f859-5786-53a1-39be-b678ddbacd56-b5a84b13"><img src="images/icon-04.webp" loading="lazy" id="w-node-_7bab0343-76e0-d7f0-919b-6c4175c72bb5-b5a84b13" srcset="images/icon-04-p-500.webp 500w, images/icon-04-p-800.webp 800w, images/icon-04.webp 1392w" sizes="(max-width: 479px) 48vw, (max-width: 767px) 95vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-3"></div>
              <div id="w-node-_1533551e-2849-f0bf-9479-2e925e545d29-b5a84b13">
                <h6 class="heading-12">+27 66 230 4022</h6>
              </div>
              <div id="w-node-_47e5aff7-874e-52c9-045a-84fe8c68c385-b5a84b13"><img src="images/icon-05.webp" loading="lazy" id="w-node-_8ba039fa-7113-8084-3abd-ea1cc74bd5f1-b5a84b13" srcset="images/icon-05-p-500.webp 500w, images/icon-05-p-800.webp 800w, images/icon-05.webp 1392w" sizes="(max-width: 479px) 48vw, (max-width: 767px) 95vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-4"></div>
              <div id="w-node-b56d7c11-3533-446a-9f2c-a4eaf3e133d9-b5a84b13" class="div-block-29">
                <h6 class="heading-13">contact@4rizon.com</h6>
              </div>
            </div>
            <div class="" style = "display : flex;">
                  <a href="https://www.instagram.com/4rizon_za/" class="w-inline-block"><img src="images/insta.jpg" loading="lazy" alt=""></a>
               
                  <a href="https://www.facebook.com/4rizonza" class="w-inline-block"><img style = "height: 42px; width: 41px; margin-top: 11px; margin-right: 95px;" src="images/facebook.jpg" loading="lazy" alt=""></a>
              
                </div>
          </div>
          <div id="w-node-_7c2092a7-786e-3fce-4a55-b867e09686d2-b5a84b13">
            <h1 class="heading-10">Working Hours</h1>
            <div class="div-block-19">
              <h6 class="heading-11">Will be opening soon</h6>
            </div>
            
          </div>
          <div id="w-node-_2672fe8e-b26c-a35f-71f8-2191f43ed520-b5a84b13">
            <div class="w-layout-grid grid-26">
              <div id="w-node-ae45a09d-c61f-c5ed-b0e0-ba62358da8b6-b5a84b13">
                <h2 class="heading-19 heading-20">Download Our App</h2>
                <p class="paragraph-10" style = "font-size : 12px;">Download the 4rizon Application on the App store and the Playstore for some exciting new features and earn some perks!</p>
                <div class="div-block-41">
                  <a href="https://apps.apple.com/us/app/4rizon/id6443894348" class="w-inline-block"><img src="images/Group-6.png" loading="lazy" alt=""></a>
                  <div class="div-block-40">
                    <a href="https://play.google.com/store/apps/details?id=com.frizon.customer" class="w-inline-block"><img src="images/Group-7.png" loading="lazy" alt=""></a>
                  </div>
                </div>
              </div>
              <div id="w-node-_8831a1ae-69b4-4c66-42c9-16dfe114eb08-b5a84b13"><img src="images/Download-App-02-1.png" loading="lazy" alt=""></div>
            </div>
          </div>
        </div>
        <div id="w-node-fc1b37b1-f0df-ac54-e1ec-7dec7fbe4d1a-b5a84b13">
          <h3 class="heading-14">© Copyright 4rizon Bar, Lounge &amp; Musical Entertainment. 2022</h3>
        </div>
      </div>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=636417981c03ca1b09a84b12" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="new/js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
    <script>
    window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
    </script>
</body>
</html>