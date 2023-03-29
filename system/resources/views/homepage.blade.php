<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Tue Nov 08 2022 19:02:03 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="636417981c03ca1eb5a84b13" data-wf-site="636417981c03ca1b09a84b12">
<head>
  <meta charset="utf-8">
  <title>4RIZON</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
 
  <link href="{{asset('new/css/4rizon.css?v=').time()}}" rel="stylesheet" type="text/css">
  <link href="{{asset('new/css/normalize.css?v=').time()}}" rel="stylesheet" type="text/css">
  <link href="{{asset('new/css/webflow.css?v=').time()}}" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Mulish:300,regular,500,600,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon-32x32.png" rel="shortcut icon" type="image/x-icon">
  <style>
    #myVideo {
  position: absolute;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}
@media screen and (min-width: 1440px){
.div-block-2 {
    margin-top: 200px;
}
}
@media screen and (min-width: 1024px){
.div-block-2 {
    margin-top: 260px;
}
}
@media screen and (max-width: 767px){
.div-block-2 {
    margin-top: 450px;
}
}
@media screen and (max-width: 479px) {
  .div-block-2 {
    margin-top: 340px;
}
}
@media screen and (max-width: 320px) {
  .brand w-nav-brand{
    margin-left: -35px;
}
}
.brand {
    position: relative;
    left: 5%;
    bottom: 8px;
    text-align: justify;
}
.nav-menu{
  padding:0%;
  background-color: black;
  margin-top: 44px;
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

  </style>
</head>
<body class="body">
  <video width="" height=""  muted loop id="myVideo">
          <source src="new/images/WhatsApp Video 2022-12-01 at 10.03.16 AM.mp4" type="video/mp4">
          <source src="new/images/WhatsApp Video 2022-12-01 at 10.03.16 AM.mp4" type="video/ogg">
        Your browser does not support the video tag.
        </video>
  <div class=" wf-section">
    <div data-animation="default"  data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
      <div class="container-10 w-container" style="max-width: 85%;">
        <a href="#" class="brand w-nav-brand"><img src="images/LOGO-01-1.svg" loading="lazy" height="155" width="160" style="    margin-left: 0px; filter: contrast(6.5);" alt="" class="image"  filter: contrast(6.5)></a>
        <nav role="navigation" id = "navbar" class="nav-menu w-nav-menu" style="font-weight:bold;">
          <a href="{{ route('homepage') }}" aria-current="page" class="nav-link w-nav-link w--current">Home</a>
          <a href="{{ route('event-page') }}" class="nav-link-2 w-nav-link">Events</a>
          <a href="{{ route('gallery1') }}" class="nav-link-2 w-nav-link">Gallery</a>
          <a href="{{ route('about-us') }}" class="nav-link-2 w-nav-link">About Us</a>
          <a href="{{ route('contact-us') }}" class="nav-link-3 w-nav-link">Contact Us</a>
          <a href="{{ route('register') }}" class="nav-link-3 w-nav-link">Register</a>
          <a href="{{ route('book-event') }}" class="nav-link-3 w-nav-link" style="">Book Event</a>
        </nav>
        <div class="menu-button w-nav-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
    <div class="container w-container">
      <div>
        <div class="div-block-23">
          <h1 class="heading">Welcome to 4rizon</h1>
          <p class="paragraph">A totally new immersive nightlife experience</p>
          <button id="myBtn" style="background:none;" onclick="myFunction()"><i class="fa fa-play-circle btn" style="font-size:50px; color:white"></i></button>
        </div>
      </div>
    </div>
    <div class="div-block" style="
     background-image: url('images/Background12.png'); top = '75px'">
      <div class="w-layout-grid grid" >
      @foreach ($event_list as $event)
        <div id="w-node-c0194ae0-6f01-f412-c3f3-8c9e5a4976cb-b5a84b13" class="div-block-5"  >
          <div>
            <h2 class="heading-4">{{$event['event_name']}}</h2>
            <p class="paragraph-4">{{ date('l d M Y', strtotime($event['event_date']))}}</p>
          </div>
          <div class="div-block-7">
            <a href="{{ route('book-event') }}" class="button w-button">Book Event</a>
          </div>
        </div>
      @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="about-section wf-section">
    <div class="container-3 w-container">
      <div class="div-block-2">
        <div class="w-layout-grid grid-2">
          <div id="w-node-_1e5210d8-f43d-d7f9-dd70-bacb891cd703-b5a84b13">
            <div class="w-layout-grid grid-3">
              <div id="w-node-_43e517c2-020e-9e08-edfa-4f6266ac407d-b5a84b13"><img src="images/1.webp" loading="lazy" srcset="images/1-p-500.webp 500w, images/1-p-800.webp 800w, images/1-p-1080.webp 1080w, images/1.webp 1174w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt=""></div>
              <div id="w-node-_91bedd48-2583-0c15-1adf-5e0696ce7b81-b5a84b13" class="div-block-9"><img src="images/2.webp" loading="lazy" srcset="images/2-p-500.webp 500w, images/2-p-800.webp 800w, images/2-p-1080.webp 1080w, images/2.webp 1188w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt=""></div>
            </div>
          </div>
          <div id="w-node-_84d9da0c-e34b-51fd-a7a7-36e66481dc71-b5a84b13" class="div-block-10">
            <h1 id="w-node-a14fd459-4267-ecc2-1926-19c924158524-b5a84b13" class="heading-5">About 4rizon</h1>
            <p class="paragraph-6">Welcome to 4rizon
                The most smoking and exciting new club in Johannesburg, bringing a completely new energy and involvement in an astounding 3 phase landscape, VIP Booths, Iridescent lighting, extraordinary sounds, astonishing music, beverages, and amazing food.</p>
            <p class="paragraph-6">We mean to bring you a totally new immersive nightlife experience with the best DJs and Specialists. Now is the ideal time to take your entertainment to the next level.</p>
            {{-- <div class="div-block-11" >
              <a  href="#" class="button w-button" hidden>Learn More</a>
            </div> --}}
          </div>
        </div>
        <div class="div-block-12">
          <div class="w-layout-grid grid-4">
            <div id="w-node-da97c73e-57e2-b1cd-f665-a1b02e73308d-b5a84b13">
              <h1 class="heading-5">Merch Coming Soon</h1>
              <p class="paragraph-6">Be on the lookout for when we discharge our interesting assortment of 4rizon Outfits for you to paint the streets with, every one of the freshest and most jazzy outfits from hoodies, covers, shirts, and some more.</p>
              <p class="paragraph-6">Download our versatile application to find out more about our Merchandise assortment and other cool things 4rizon brings to the table.</p>
              <div class="div-block-14">
                <a href="{{ route('book-event') }}" class="button w-button">Download App</a>
              </div>
            </div>
            <div id="w-node-_07686d12-8e75-4ce9-c131-91dd8aa12a67-b5a84b13">
              <div class="w-layout-grid grid-5">
                <div id="w-node-_95c120b3-aa55-9876-464e-f69f89f94677-b5a84b13" class="div-block-21"><img src="images/3.webp" loading="lazy" srcset="images/3-p-500.webp 500w, images/3-p-800.webp 800w, images/3-p-1080.webp 1080w, images/3.webp 1286w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt=""></div>
                <div id="w-node-_9c055f86-8b68-3c6e-4f31-05466eb2a6e6-b5a84b13" class="div-block-13"><img src="images/4.webp" loading="lazy" srcset="images/4-p-500.webp 500w, images/4-p-800.webp 800w, images/4-p-1080.webp 1080w, images/4.webp 1236w" sizes="(max-width: 767px) 96vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="banner-section wf-section">
    <div class="w-layout-grid grid-6">
      <div id="w-node-_9927f0f7-d9f9-4cb2-d6a0-88d0a2548b4c-b5a84b13"><img src="images/11.webp" loading="lazy" srcset="images/11-p-500.webp 500w, images/11-p-800.webp 800w, images/11-p-1080.webp 1080w, images/11-p-1600.webp 1600w, images/11.webp 1732w" sizes="(max-width: 1919px) 100vw, 1731.998046875px" alt=""></div>
      <div id="w-node-eeb3cd6c-ab3c-32ff-a5ac-deb98b01d831-b5a84b13" class="div-block-15">
        <div class="div-block-16">
          <h1 class="heading-6">All we&#x27;ve got is NOW! </h1>
          <h1 class="heading-7">Be young.</h1>
          <h1 class="heading-9">Be proud.</h1>
          <h1 class="heading-8">Be cool.</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="gallery-section wf-section">
    <div class="container-2 w-container">
      <h1 class="heading-5">Gallery</h1>
      @foreach($gallery1 as $g)@endforeach
      @foreach($gallery2 as $g2)@endforeach
      @foreach($gallery3 as $g3)@endforeach
      @foreach($gallery4 as $g4)@endforeach
      @foreach($gallery5 as $g5)@endforeach
      <div>
        <div class="w-layout-grid grid-12">
          <div id="w-node-_39887752-2f57-3bb9-5533-f941c836ef7c-b5a84b13">
            <div class="w-layout-grid grid-20">
              <div id="w-node-ae7c648e-66b0-536a-827e-4e76233a0927-b5a84b13"><img src="image/{{$g['image']}}" loading="lazy" srcset="image/{{$g['image']}} 500w, image/{{$g['image']}} 504w" height="204px" width="auto" sizes="(max-width: 767px) 96vw, 503.9961853027344px" id="w-node-_59931ce0-5e56-236b-524b-88dc8e4c1562-b5a84b13" alt=""></div>
              <div id="w-node-_6302015f-cf70-fe75-71cc-76d6cccc0f50-b5a84b13"><img src="image/{{$g2['image']}}" loading="lazy" srcset="image/{{$g2['image']}} 500w, image/{{$g2['image']}} 504w" height="204px" width="auto" sizes="(max-width: 767px) 96vw, 503.9961853027344px" alt="" class=""></div>
            </div>
          </div>
          <div id="w-node-fd8faff3-ac0e-53e1-817f-da6a2c65a748-b5a84b13"><img src="image/{{$g4['image']}}" height="423px" width="auto" loading="lazy" alt="" class=""></div>
          <div id="w-node-_39887752-2f57-3bb9-5533-f941c836ef7c-b5a84b13">
            <div class="w-layout-grid grid-20">
              <div id="w-node-ae7c648e-66b0-536a-827e-4e76233a0927-b5a84b13"><img src="image/{{$g2['image']}}" loading="lazy" srcset="image/{{$g2['image']}} 500w, image/{{$g2['image']}} 504w" height="204px" width="auto" sizes="(max-width: 767px) 96vw, 503.9961853027344px" id="w-node-_59931ce0-5e56-236b-524b-88dc8e4c1562-b5a84b13" alt=""></div>
              <div id="w-node-_6302015f-cf70-fe75-71cc-76d6cccc0f50-b5a84b13"><img src="image/{{$g5['image']}}" loading="lazy" srcset="image/{{$g5['image']}} 500w, image/{{$g5['image']}} 504w" height="204px" width="auto" sizes="(max-width: 767px) 96vw, 503.9961853027344px" alt="" class=""></div>
            </div>
          </div>
        </div>
      </div>
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
  <script>
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    e.target.textContent = '<i class="fa fa-pause"></i>'
  } else {
    video.pause();
    e.target.textContent = '<i class="fa fa-play"></i>'
  }
}
const pauseIconClassName = 'fa-pause-circle'
const playIconClassName = 'fa-play-circle'

const btns = document.querySelectorAll('.btn')
function onChange (event) {
  // get the button elememt from the event
    const buttonElement = event.currentTarget
  
  // check if play button class is present on our button
  const isPlayButton = buttonElement.classList.contains(playIconClassName)
  
  // if a play button, remove the play button class and add pause button class
  if (isPlayButton) {
    buttonElement.classList.remove(playIconClassName)
    buttonElement.classList.add(pauseIconClassName)
    
    // if a pause button, remove pause button class and add play button class
  } else {
    buttonElement.classList.remove(pauseIconClassName)
    buttonElement.classList.add(playIconClassName)
  }


  // You can also use .toggle function on classList as mentioned by the person in other answer
}
btns.forEach(btn => {
    btn.addEventListener('click', onChange)
})
</script>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=636417981c03ca1b09a84b12" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="/new/js/webflow.js" type="text/javascript"></script>
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
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
