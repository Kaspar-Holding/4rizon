<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Tue Nov 08 2022 19:02:03 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="63644523acc17932e30a8bda" data-wf-site="636417981c03ca1b09a84b12">
<head>
  <meta charset="utf-8">
  <title>Event-page</title>
  <meta content="Event-page" property="og:title">
  <meta content="Event-page" property="twitter:title">
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
</head>
<body class="body-2">
  <div class="main-section wf-section">
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar-2 w-nav">
      <div class="w-container">
        <a href="#" class="w-nav-brand"><img src="images/LOGO-01-1.svg" loading="lazy" alt="" class="image-5 image-6"></a>
        <nav role="navigation" class="nav-menu-2 w-nav-menu">
          <a href="{{ route('homepage') }}" aria-current="page" class="nav-link w-nav-link">Home</a>
          <a href="{{ route('event-page') }}" class="nav-link-2 w-nav-link w--current">Events</a>
          <a href="{{ route('gallery1') }}" class="nav-link-2 w-nav-link">Gallery</a>
          <a href="{{ route('about-us') }}" class="nav-link-2 w-nav-link">About Us</a>
          <a href="{{ route('contact-us') }}" class="nav-link-3 w-nav-link">Contact</a>
          <a href="{{ route('book-event') }}" class="nav-link-3 button w-nav-link">Book Event</a>
        </nav>
        <div class="menu-button-2 w-nav-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
    <div class="container-5 w-container">
      <div>
        <h1 class="heading-15">Upcoming Events</h1>
      </div>
    </div>
  </div>
  <div class="events wf-section">
    <div class="container-6 w-container">
      <div>
        <div class="w-layout-grid grid-14">
          <div id="w-node-_9a8c6244-0816-b407-bda3-415b577fda87-e30a8bda" class="div-block-24"></div>
          <div id="w-node-_44b47dcc-fa36-a317-2391-ac345425520d-e30a8bda" class="div-block-25"></div>
        </div>
        <div class="div-block-26">
          <div class="w-layout-grid grid-15">
            @foreach ($event_list as $event)
                <div id="w-node-_63f0f9a8-7dc0-ac4c-1892-a756653ae65e-e30a8bda">
                  <div class="w-layout-grid grid-16">
                    <div id="w-node-_346e9f91-eb85-6676-fc75-91adb38748b7-e30a8bda"><img src="image/{{$event['event_image']}}" loading="lazy"  sizes="(max-width: 479px) 96vw, (max-width: 767px) 97vw, 604.9999389648438px" alt="" style="width:500px;height:500px;"></div>
                    <div id="w-node-abe0d26a-7e21-ffd5-2fad-088e6ed55d82-e30a8bda">
                      <h3 class="heading-16">{{$event['event_name']}}</h3>
                      <p class="paragraph-7">{{ date('l d M Y', strtotime($event['event_date']))}}</p>
                      <div class="div-block-27">
                        <a href="#" class="link">Book Event</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-section wf-section">
    <div class="container-4 w-container">
      <div class="div-block-17">
        <div class="w-layout-grid grid-10">
          <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87a3-e30a8bda" class="div-block-20">
            <p class="paragraph-5">A totally new nightlife immersive experience with the best DJs and Specialists. Now is the ideal time to take your entertainment to a higher level.</p>
          </div>
          <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87a6-e30a8bda">
            <h1 class="heading-10">Contact Us</h1>
            <div class="w-layout-grid grid-11">
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87aa-e30a8bda"><img src="images/icon-03.webp" loading="lazy" width="696" id="w-node-_254a3667-04af-9272-e671-61cf2c3f87ab-e30a8bda" sizes="(max-width: 479px) 57vw, (max-width: 767px) 91vw, 695.9942626953125px" srcset="images/icon-03-p-500.webp 500w, images/icon-03-p-800.webp 800w, images/icon-03.webp 1392w" alt="" class="image-2"></div>
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87ac-e30a8bda">
                <h6 class="heading-11">Fourways, Johannesburg</h6>
              </div>
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87af-e30a8bda"><img src="images/icon-04.webp" loading="lazy" id="w-node-_254a3667-04af-9272-e671-61cf2c3f87b0-e30a8bda" srcset="images/icon-04-p-500.webp 500w, images/icon-04-p-800.webp 800w, images/icon-04.webp 1392w" sizes="(max-width: 479px) 48vw, (max-width: 767px) 95vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-3"></div>
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87b1-e30a8bda">
                <h6 class="heading-12">Fourways, Johannesburg</h6>
              </div>
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87b4-e30a8bda"><img src="images/icon-05.webp" loading="lazy" id="w-node-_254a3667-04af-9272-e671-61cf2c3f87b5-e30a8bda" srcset="images/icon-05-p-500.webp 500w, images/icon-05-p-800.webp 800w, images/icon-05.webp 1392w" sizes="(max-width: 479px) 48vw, (max-width: 767px) 95vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-4"></div>
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87b6-e30a8bda" class="div-block-29">
                <h6 class="heading-13">Fourways, Johannesburg</h6>
              </div>
            </div>
          </div>
          <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87b9-e30a8bda">
            <h1 class="heading-10">Working Hours</h1>
            <div class="div-block-19">
              <h6 class="heading-11">Mon - Wed : 9 PM - 4 AM</h6>
            </div>
            <div class="div-block-18">
              <h6 class="heading-12">Thu - Fri : 9 PM - 4 AM</h6>
            </div>
          </div>
          <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87c2-e30a8bda">
            <div class="w-layout-grid grid-26">
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87c4-e30a8bda">
                <h2 class="heading-19 heading-20">Download Our App</h2>
                <p class="paragraph-10">Download the 4rizon Application on the App store and the Playstore for some exciting new features and earn some perks!</p>
                <div class="div-block-41">
                  <a href="#" class="w-inline-block"><img src="images/Group-6.png" loading="lazy" alt=""></a>
                  <div class="div-block-40">
                    <a href="#" class="w-inline-block"><img src="images/Group-7.png" loading="lazy" alt=""></a>
                  </div>
                </div>
              </div>
              <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87cf-e30a8bda"><img src="images/Download-App-02-1.png" loading="lazy" alt=""></div>
            </div>
          </div>
        </div>
        <div id="w-node-_254a3667-04af-9272-e671-61cf2c3f87d1-e30a8bda">
          <h3 class="heading-14">Copyright 4rizon Bar, lounge &amp; Musical Entertainment. 2022</h3>
        </div>
      </div>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=636417981c03ca1b09a84b12" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="new/js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>